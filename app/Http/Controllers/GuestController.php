<?php

namespace App\Http\Controllers;

use App\Models\{Guest,Contact, Meeting, Score,Member,Club};
use App\Http\Requests\StoreGuestRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGuestRequest;
use App\MyPaginator;
use App\MemberHelper;
use App\Http\Resources\GuestResource;
use MemberHelper as GlobalMemberHelper;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public static function buildMemberSelect()
    {
        $members='<option value=""></option>';
        foreach (Member::all('id','name') as $member)
        {
            $members=$members.'<option value="'.$member->id.'">'.$member->name.'</option>';
        }

        return $members;
    }


    public static function buildClubSelect()
    {
        $clubs='<option value=""></option>';
        foreach (Club::all('id','name') as $club)
        {
            $clubs=$clubs.'<option value="'.$club->id.'">'.$club->name.'</option>';
        }

        return $clubs;
    }



    public function list(Request $request )
    {

        //  dd($request->all());
      return [
              'search'=>$request->input('search')?:null,
              'burl'=>base_path(),
              'members'=>GuestController::buildMemberSelect(),
              'clubs'=>GuestController::buildClubSelect(),
              'guests'=>MyPaginator::paginate(GuestResource::collection(Guest::query()
                                                                        ->when($request->has('search')&&(array_key_exists('type',$request->search)),fn($q,$search)=>$q->whereIn('type',collect($request->search['type'])->pluck('name')))
                                                                        ->when($request->has('search')&&($request->search['guest']),fn($query)=>($query->where('name','like','%'.$request->search['guest'].'%')
                                                                        ->orWhere('field','like','%'.$request->search['guest'].'%')
                                                                        ->orWhereHas('contacts',fn($q)=>$q->where('contact','like','%'.$request->search['guest'].'%'))

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
       $Guest=Guest::create($request->only(['name','gender','field','type','nationality','member_id','club_id']));
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
        //show the form to edit a Guest
        // dd('here');
        return inertia('Guest/Edit', ['guest'=>GuestResource::make($guest),'members'=>Member::all('name','id'),'clubs'=>Club::all('name','id')]);
    }

    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        $guest->contacts()->delete();

         Contact::create([
                          'contact'=>$request->email,
                          'contact_type'=>'email',
                          'contactable_type'=>'App\Models\Guest',
                          'contactable_id'=>$guest->id,
                          'default'=>true

                 ]);
        if ($request->has('phone'))
        {
            Contact::create([
                            'contact'=>$request->phone,
                            'contact_type'=>'phone',
                            'contactable_type'=>'App\Models\Guest',
                            'contactable_id'=>$guest->id,
                            'default'=>true

                            ]);
        }

        $guest->update($request->all());
        $request->session()->flash('flash.banner', 'Success!');
        return redirect(Route('guest.show',$guest->id));
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
