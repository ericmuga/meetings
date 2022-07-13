<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GuzzleHttp\Client;
use App\Models\{Contact, GradingRule, Guest, Meeting, Participant, Score, ZoomMeeting};
use Carbon\Carbon;
use Inertia\Inertia;
use \Tuqqu\GenderDetector\GenderDetector;

class ZoomController extends Controller
{

    public $st;
    public $ed;






    public function fetchParticipants(Meeting $meeting,$next_page_token='')
    {
        /**
         *
         * This method will return participants for a given zoom meeting.
         * The meeting must have been saved in the database with a given UUID
         */

         //https://api.zoom.us/v2/metrics/meetings/{meetingId}/participants
         //https://api.zoom.us/v2/report/meetings/{meetingId}/participants

         $page_size=50;

         $client = new Client(['base_uri' => env('ZOOM_BASE_URL')]);
        //    dd(env('ZOOM_BASE_URL'));
        $arr_request = [
                            "headers" => [
                                            "Authorization" => "Bearer ".ZoomController::getZoomAccessToken()
                                        ],
                            "query" => [              "page_size"=>$page_size,
                                                      "type"=>'pastOne',  //"past" "pastOne" "live"

                                    ]
                        ];


                if (!empty($next_page_token))
                {
                    $arr_request['query'] = [       "next_page_token" => $next_page_token,
                                                    "page_size"=>$page_size,
                                                    "type"=>'pastOne',  //"past" "pastOne" "live"


                                            ];
                }

             $response = $client->request('GET', 'report/meetings/'.$meeting->uuid.'/participants', $arr_request);

            $data = json_decode($response->getBody());
           // dd($data);

       if (!empty($data)&& isset($data->participants) ) {
          foreach ( $data->participants as $participant )
          {
               if(!Participant::where('meeting_id',$meeting->id)
                          ->where('email',$participant->user_email)
                          ->where('join_time',$participant->join_time)
                          ->exists()
                 )
                 {
                     Participant::create(['instance_uuid'=>$meeting->uuid,
                                          'email'=>$participant->user_email,
                                          'join_time'=>$participant->join_time,
                                          'leave_time'=>$participant->leave_time,
                                          'meeting_id'=>$meeting->id,
                                         ]);
                 }

                 $attendable=ZoomController::getAttendable($participant);

             if(!Score::where('meeting_id',$meeting->id)
                          ->where('attendable_type',$attendable['type'])
                          ->where('attendable_id',$attendable['id'])
                          ->exists()
                 )
                 {
                      Score::create([
                                     'meeting_id'=>$meeting->id,
                                     'attendable_type'=>$attendable['type'],
                                     'attendable_id'=>$attendable['id'],
                                     'time_score'=>0,
                                     'present'=>false,
                                 ]);
                 }


                 if ( !empty($data->next_page_token) ) {
                  ZoomController::fetchParticipants($meeting,$data->next_page_token);


            }
        }

    }

     return redirect(route('meeting.show',$meeting->id));
    }

    public static function getAttendable($participant)
    {
       if (!Contact::where('contact_type','email')
                   ->where('contact',$participant->user_email)
                   ->exists()
          )
          {
              $gender='';

             $guest=Guest::create([
                              'name'=>$participant->name,
                              'nationality'=>'KE',
                              'gender' =>$gender,
                        ]);
                    Contact::create(['contact'=>$participant->user_email,
                                     'contact_type'=>'email',
                                     'contactable_type'=>'App\Models\Guest',
                                     'contactable_id'=>$guest->id,
                                     'default'=>true,
                    ]);

            return ['type'=>'App\Models\Guest',
                    'id'=>$guest->id
                  ];

        }
        else
        {
             $contact=Contact::where('contact_type','email')->where('contact',$participant->user_email)->select('contactable_type','contactable_id')->first();
            return [
                      'type'=>$contact->contactable_type,
                      'id'=>$contact->contactable_id,
                   ];
        }
    }



    public function getMeetings(Request $request)
    {
      ZoomController::list_meetings(null,$request->Start,$request->end);

      $fellowshipMeetings=ZoomMeeting::where('title','like','%fellowship')
                                    ->orWhere('gradable',true)
                                    ->get();

            if ($fellowshipMeetings->count()>0) {
                foreach ($fellowshipMeetings as $meeting)
                {
                     $instances=ZoomController::meetingInstances($meeting);

                    foreach ($instances->meetings as $instance)
                    {

                        if (!GradingRule::where('name','Zoom')->exists()) return redirect(route('meeting.index'));
                        else $rule=GradingRule::firstWhere('name','Zoom');

                        $d=ZoomController::getInstanceDetails($instance);
                        if(!Meeting::where('uuid',$d->uuid)->exists())
                          if(($d->participants_count>=$rule->minimum_members) && ($d->duration>=$rule->minimum_minutes))
                              Meeting::create([
                                                    'type'=>'zoom',
                                                    'date'=>Carbon::parse($d->start_time)->toDateString(),
                                                    'venue'=>'online',
                                                    'topic'=>$d->topic,
                                                    'host'=>'default',
                                                    'uuid'=>$d->uuid,
                                                    'grading_rule_id'=>$rule->id,
                                                    'club_id'=>1,
                                                    'official_start_time'=>$d->start_time,
                                                    'official_end_time'=>$d->end_time,
                                                    'meeting_no'=>$d->id,
                                                    // 'meeting'=>$d->participants
                                                    ]);

                                }

                }

      }

       ZoomController::spruceMeetings();
       return redirect(route('meeting.index'));
    }

        public function spruceMeetings()
        {
            $zoomDates=Meeting::where('type','zoom')->groupBy('date')->selectRaw('count(*) as meetings, date')->get();
            foreach ($zoomDates as $zd)
            {
                Meeting::where('date',$zd->date)
                       ->where('id','<>',Meeting::where('date',$zd->date)->orderBy('official_start_time','desc')->first()->id)
                       ->update(['gradable'=>false]);

                       Meeting::where('date',$zd->date)->orderBy('official_start_time','desc')->first()
                              ->update(['gradable'=>true]);
            }
        }

     public static function getInstanceDetails($instance)
    {
        # code...
           $cleanUUID=(str_contains($instance->uuid,'/'))?urlencode(urlencode($instance->uuid)):$instance->uuid;

         $client = new Client(['base_uri' => 'https://api.zoom.us/']);

        $arr_request = [
            "headers" => [
                            "Authorization" => "Bearer ".ZoomController::getZoomAccessToken()
            ]];
          $response = $client->request('GET', '/v2/past_meetings/'.$cleanUUID, $arr_request);

            return json_decode($response->getBody());



    }

    public static function meetingInstances($meeting)
    {
        # code...
        $instances=[];

         $client = new Client(['base_uri' => 'https://api.zoom.us/']);

        $arr_request = [
            "headers" => [
                            "Authorization" => "Bearer ".ZoomController::getZoomAccessToken()
            ]];
          $response = $client->request('GET', '/v2/past_meetings/'.$meeting->meeting_no.'/instances', $arr_request);

          //return only the latest instance per date.
         // $instances=json_decode($response->getBody());

          return json_decode($response->getBody());

           //dd($data);
    }


    public static function  getZoomAccessToken() {
            $key = env('JWT_APP_SECRET','');
            $payload = array(
                "iss" =>env('JWT_APP_KEY',''),
                "exp" =>strtotime("20:14 07/09/2024")
            );
            //return env('ZOOM_TK');
           return JWT::encode($payload, $key,'HS256');


    }


    public  static function createZoomMeeting() {
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'https://api.zoom.us',
            ]);

            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer " .ZoomController::getZoomAccessToken()
                ],
                'json' => [
                    "topic" => "Test JWT Auth",
                    "type" => 2,
                    "start_time" => "2022-05-30T20:30:00",
                    "duration" => "30", // 30 mins
                    "password" => "123456"
                ],
            ]);

            $data = json_decode($response->getBody());
            echo "Join URL: ". $data->join_url;
            echo "<br>";
            echo "Meeting Password: ". $data->password;
        }

public static function list_meetings($next_page_token = '',$st=null,$ed=null) {
    $client = new Client(['base_uri' => 'https://api.zoom.us/v2/']);

    $arr_request = [
        "headers" => [
                        "Authorization" => "Bearer ".ZoomController::getZoomAccessToken()
        ],
        "query" => [              "from"=>$st,
                                  "to"=>$ed,
                                  "type"=>'scheduled'
    ],


    ];

    if (!empty($next_page_token)) {
        $arr_request['query'] = ["next_page_token" => $next_page_token,
                                  "from"=>$st,
                                  "to"=>$ed,
                                  "type"=>'scheduled'
                                ];
    }

    $response = $client->request('GET', 'users/me/meetings/', $arr_request);

    $data = json_decode($response->getBody());

    if ( !empty($data) ) {
        $meetingcount=0;
        //dd($data->meetings);
        foreach ( $data->meetings as $d ) {




            if(!ZoomMeeting::where('meeting_no',$d->id)->exists())
                //$meetingcount++;
                   ZoomMeeting::create([
                                        'meeting_no'=>$d->id?:0,
                                        'gradable'=>(!stripos($d->topic,'fellowship'))>1?true:false,
                                        'title'=>$d->topic,
                                        'uuid'=>((str_contains($d->uuid,'/'))?urlencode(urlencode($d->uuid)):$d->uuid)?:'',
                                        ]);
           if ( !empty($data->next_page_token) ) {
            ZoomController::list_meetings($data->next_page_token);


            }
        }

    }

}

public static function deleteZoomMeeting($meeting_id) {
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.zoom.us',
    ]);

    $response = $client->request("DELETE", "/v2/meetings/$meeting_id", [
        "headers" => [
            "Authorization" => "Bearer " .ZoomController::getZoomAccessToken()
        ]
    ]);

    if (204 == $response->getStatusCode()) {
        echo "Meeting deleted.";
    }
}


public static function getMeetingParticipants($meeting_id)
{
        $client = new Client(['base_uri' => 'https://api.zoom.us']);

        $response = $client->request('GET', '/v2/past_meetings/'.$meeting_id.'/participants', [
            "headers" => [
                "Authorization" => "Bearer ". ZoomController::getZoomAccessToken()
            ]
        ]);

        $data = json_decode($response->getBody());
        if ( !empty($data) ) {
            foreach ( $data->participants as $p ) {
                $name = $p->name;
                $email = $p->user_email;
                echo "Name: $name";
                echo "Email: $email";
            }
        }
}



}
