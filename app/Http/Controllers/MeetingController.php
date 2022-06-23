<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\MyPaginator;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;
use App\Models\{Meeting,Club,GradingRule,Member,Guest};
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
              'meetings'=>MyPaginator::paginate(MeetingResource::collection(Meeting::query()
                                                                                   ->withCount(['members','guests'])
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
                 'members_count'=>$meeting->members()->count(),
                 'members'=>$meeting->members()->get(),
                 'guests_count'=>$meeting->guests()->count(),
                 'guests'=>$meeting->guests()->get(),

                 'MemberList'=>Member::all('id','name','member_no'),
                 'GuestList'=>Guest::all('id','name')
               ];
    }


    public function show(Meeting $meeting)
    {
        //  dd(MeetingResource::make($meeting->withCount(['members','guests'])->with(['members','guests'])));

        return inertia('Meeting/Show',['meeting'=>collect(MeetingResource::make($meeting))->merge($this->stats($meeting)),

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
        //
    }
}
