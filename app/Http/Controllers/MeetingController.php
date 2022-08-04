<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Http\Resources\MakeupRequestResource;
use App\MyPaginator;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;
use App\Models\{Meeting,Club,GradingRule,Member,Guest,Score,MakeupRequest};
use Carbon\Carbon;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;

// $slug = Str::of('Laravel Framework')->slug('-');
class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request )
    {


      return [
              'search'=>$request->input('search')?:null,
              'types'=>['zoom','physical','makeup'],
              'requests'=>MakeupRequest::all(),
              'meetings'=>MyPaginator::paginate(MeetingResource::collection(Meeting::where('gradable',true)
                                                                                   ->orderBy('date','desc')
                                                                                   ->get()
                                                                              ),$request->input('perPage')?:16,null,['path'=>url()->full()]
                                                                              )->withQueryString()


              ];



    }

     public function index(Request $request)
    {
        //list all the meetings
          return inertia('Meeting/Index',$this->list($request));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Meeting/Create',['clubs'=>Club::all('id','name'),'grading_rules'=>GradingRule::all('id','name')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeetingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetingRequest $request)
    {
        // dd($request->all());
        Meeting::create($request->all());
        return redirect(route('meeting.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     *
     *
     *
     */

    public function stats($meeting)
    {
        # code...
        //meetings attended by the member
        return [
                //  'members_count'=>$meeting->members()->count(),
                 'members'=>Score::where('attendable_type','App\Models\Member')
                                ->where('meeting_id',$meeting->id)
                                ->select('attendable_id')
                                ->get()->pluck('attendable_id')
                                ->toArray(),
                 'guests'=>Score::where('attendable_type','App\Models\Guest')
                                ->where('meeting_id',$meeting->id)
                                ->select('attendable_id')
                                ->get()->pluck('attendable_id')
                                ->toArray(),
                 'MemberList'=>Member::orderBy('name')->get(),
                 'GuestList'=>Guest::all('id','name'),
                 'memberSelect'=>GuestController::buildMemberSelect(),
                 'clubSelect'=>GuestController::buildClubSelect(),
                 'requests'=>MakeupRequestResource::collection(MakeupRequest::whereNull('approver')->get()),
               ];
    }


    public function show(Meeting $meeting)
    {
        // dd($meeting->scores()->count());
        return inertia('Meeting/Show',[
                                      'meeting'=>collect(MeetingResource::make($meeting))->merge($this->stats($meeting)),

                                      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeetingRequest  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
          $meeting->scores()->delete();
          $meeting->delete();
          return back();
    }

    public function scores(Request $request)
    {
    //    dd($request->all());

        $meeting=Meeting::find($request->meeting);
          $meeting->scores()->delete();

         foreach ($request->attended as $member)
        {
            Score::where('meeting_id',$request->meeting)
                 ->where('attendable_type','App\Models\Member')
                 ->where('attendable_id',$member)
                 ->delete();
            Score::insert(['meeting_id'=>$request->meeting,
                           'attendable_type'=>'App\Models\Member',
                           'attendable_id'=>$member,
                           'present'=>true,
                           'time_score'=>Carbon::parse($meeting->official_start_time)->diffInMinutes(Carbon::parse($meeting->official_start_time)),
                          ]);
        }


        foreach ($request->guestsAttended as $guest)
        {
            Score::where('meeting_id',$request->meeting)
                 ->where('attendable_type','App\Models\Guest')
                 ->where('attendable_id',$guest)
                 ->delete();

            Score::insert(['meeting_id'=>$request->meeting,
                           'attendable_type'=>'App\Models\Guest',
                           'attendable_id'=>$guest,
                           'present'=>true,
                           'time_score'=>Carbon::parse($meeting->official_start_time)->diffInMinutes(Carbon::parse($meeting->official_start_time)),
                        ]);
        }

        return back();
    }
}
