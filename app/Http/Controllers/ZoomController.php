<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GuzzleHttp\Client;
use App\Models\{Meeting,ZoomMeeting};

class ZoomController extends Controller
{

    public $st;
    public $ed;

    public function getMeetings(Request $request)
    {
      ZoomController::list_meetings(null,$request->Start,$request->end);

    }

    public static function  getZoomAccessToken() {
            $key = env('JWT_APP_SECRET','');
            $payload = array(
                "iss" =>env('JWT_APP_KEY',''),
                "exp" =>1657918800//strtotime("17:06 07/16/2022")
            );
            return 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlRUdkUzOW5iUi1LajZrWDdiNXgyc1EiLCJleHAiOjE3MjA1NDAwODAsImlhdCI6MTY1NzM3NjQzM30.V3BtKvW_LOzCpC7_KpAtOyxBEbmAHu9rl3BAKSu1CDI';
           //return 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlRUdkUzOW5iUi1LajZrWDdiNXgyc1EiLCJleHAiOjE2NTc5ODAzODcsImlhdCI6MTY1NzM3NTU4N30.7mF8iIo4d984ZzD7F10iABDwF5v1zUgnSPECi0jfITk';
           return JWT::encode($payload, $key,'HS256');
            // return 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IlRUdkUzOW5iUi1LajZrWDdiNXgyc1EiLCJleHAiOjE2NDk5Mzg5ODgsImlhdCI6MTY0OTMzNDE4OH0.So0mJbQAipZi5azENcU1yMNtsbODG4OKvcRdILA0E54';


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
        "query" => [                    "from"=>$st,
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
        foreach ( $data->meetings as $d ) {

            //populate the list of meetings here

            /*
                "agenda": "My Meeting",
                "created_at": "2022-03-23T05:31:16Z",
                "duration": 60,
                "host_id": "30R7kT7bTIKSNUFEuH_Qlg",
                "id": 97763643886,
                "join_url": "https://example.com/j/11111",
                "pmi": "97891943927",
                "start_time": "2022-03-23T06:00:00Z",
                "timezone": "America/Los_Angeles",
                "topic": "My Meeting",
                "type": 2,
                "uuid": "aDYlohsHRtCd4ii1uC2+hA=="

            */
            //dd($d);

            /**
             *  $table->id();
            $table->unsignedBigInteger('meeting_no');
            $table->string('uuid)->nullable();
            $table->boolean('gradable');
            $table->foreignIdFor(ZoomUser::class);
            $table->timestamps();
             */


            if(!ZoomMeeting::where('meeting_no',$d->id)->exists())
                $meetingcount++;
                   ZoomMeeting::create([
                    'meeting_no'=>$d->id?:0,
                    'gradable'=>false,
                    // 'user_id'=>auth()->user(),
                     'uuid'=>((str_contains($d->uuid,'/'))?urlencode(urlencode($d->uuid)):$d->uuid)?:'',
                    ]);
           if ( !empty($data->next_page_token) ) {
            ZoomController::list_meetings($data->next_page_token);


            }
        }

    }
    return 'done!'.$meetingcount.'added';
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
