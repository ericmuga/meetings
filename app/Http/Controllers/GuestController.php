<?php

namespace App\Http\Controllers;

use App\Models\{Guest,Contact, Meeting, Score,Member};
use App\Http\Requests\StoreGuestRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGuestRequest;
use App\MyPaginator;
use App\Http\Resources\GuestResource;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function buildMemberSelect()
    {
        $members='';
        foreach (Member::all('id','name') as $member)
        {
            $members=$members.'<option value="'.$member->id.'">'.$member->name.'</option>';
        }

        return $members;
    }
    public function list(Request $request )
    {


      return [
              'search'=>$request->input('search')?:null,
              'burl'=>base_path(),
              'members'=>$this->buildMemberSelect(),
              'guests'=>MyPaginator::paginate(GuestResource::collection(Guest::query()
                                                                                ->when($request->input('search'),
                                                                                        fn($query,$search)=>($query->where('name','like','%'.$search.'%')
                                                                                                                   ->orWhere('field','like','%'.$search.'%')
                                                                                                                   ->orWhereHas('contacts',fn($q)=>$q->where('contact','like','%'.$search.'%'))

                                                                                                            )
                                                                                       )
                                                                                      ->orderBy('name')
                                                                                      ->get()
                                                                              ),$request->input('perPage')?:16,null,['path'=>url()->full()]
                                                                              )->withQueryString()


              ];



    }


     public function index(Request $request)
    {
       //show the list of all the guests
       return inertia('Guest/Index',$this->list($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGuestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestRequest $request)
    {
        //
       $Guest=Guest::create($request->only(['name','gender','field','type','nationality','member_id']));
      //attach contacts

       Contact::create([
                          'contact'=>$request->email,
                          'contact_type'=>'email',
                          'contactable_type'=>'App\Models\Guest',
                          'contactable_id'=>$Guest->id,
                          'default'=>true

                 ]);
       if ($request->has('phone'))
       {
           Contact::create([
                          'contact'=>$request->phone,
                          'contact_type'=>'phone',
                          'contactable_type'=>'App\Models\Guest',
                          'contactable_id'=>$Guest->id,
                          'default'=>true

                         ]);
       }

       if ($request->has('meeting'))
       {
            /**
             *  Schema::create('scores', function (Blueprint $table) {
            $table->unique(['attendable_type','attendable_id','meeting_id'])->index();
            $table->foreignIdFor(Meeting::class);
            $table->morphs('attendable');
            $table->boolean('present');
            $table->float('time_score');
        });
             */

           //register the guest for that meeting
           Score::insert([
                                'attendable_type'=>'App\Models\Guest',
                                'attendable_id'=>$Guest->id,
                                'meeting_id'=>$request->meeting,
                                'present'=>true,
                                'time_score'=>30
                    ]);

           return redirect(Route('meeting.show',$request->meeting));
       }
        return redirect(Route('guest.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */

public function stats($guest)
    {
        # code...
        //meetings attended by the guest
        return [
                 'meetings'=>$guest->scores()->with(['meeting'=>fn($q)=>$q->orderBy('date','desc')])->get(),
               ];


    }
    public function show(Guest $guest)
    {
        //show the guest profile
        // dd($this->stats($guest));
        return inertia('Guest/Show',array_merge(['guest'=>GuestResource::make($guest)],$this->stats($guest)));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuestRequest  $request
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        $guest->contacts()->delete();
        $guest->scores()->delete();

        $guest->delete();

        return redirect (route('guest.index'));
    }
}
