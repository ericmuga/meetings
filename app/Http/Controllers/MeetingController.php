<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\MyPaginator;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;
use App\Models\{Meeting,Club,GradingRule,Member,Guest,Score};
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
              'meetings'=>MyPaginator::paginate(MeetingResource::collection(Meeting::orderBy('date','desc')
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
                 'members'=>$meeting->members()->get()->pluck('id')->toArray(),
                //  'guests_count'=>$meeting->guests()->count(),
                 'guests'=>$meeting->guests()->get(),

                 'MemberList'=>Member::orderBy('name')->get(),
                 'GuestList'=>Guest::all('id','name')
               ];
    }


    public function show(Meeting $meeting)
    {
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
        // dd($request->all());
        $meeting=Meeting::find($request->meeting);
        $meeting->scores()->delete();
        foreach ($request->attended as $member)
        {
            Score::create(['meeting_id'=>$request->meeting,
                           'attendable_type'=>'App\Models\Member',
                           'attendable_id'=>$member,
                           'present'=>true,
                           'time_score'=>Carbon::parse($meeting->official_start_time)->diffInMinutes(Carbon::parse($meeting->official_start_time)),
                        ]);
        }
        // $meeting->members()->detach();
        // $meeting->members()->attach($request->attended);
        return back();
    }
}
