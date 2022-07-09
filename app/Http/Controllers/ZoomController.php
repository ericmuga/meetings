<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GuzzleHttp\Client;
use App\Models\{GradingRule, Meeting,ZoomMeeting};
use Carbon\Carbon;
use Inertia\Inertia;

class ZoomController extends Controller
{

    public $st;
    public $ed;

    public function getMeetings(Request $request)
    {
      ZoomController::list_meetings(null,$request->Start,$request->end);

      $fellowshipMeetings=ZoomMeeting::where('title','like','%fellowship')
                                    ->orWhere('gradable',true)
                                    ->get();
      //dd($fellowshipMeetings);
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
                Meeting::where('date',$zd->date)->where('id','<>',Meeting::where('date',$zd->date)->orderBy('official_start_time','desc')->first()->id)
                       ->update(['gradable',false]);

                       Meeting::where('date',$zd->date)->orderBy('official_start_time','desc')
                              ->update(['gradable',true]);
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
