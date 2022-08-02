<?php

namespace App\Http\Controllers;

use App\Models\{Member,Contact,User,Score};
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
use App\MyPaginator;
use App\Http\Resources\MemberResource;
use App\Imports\MembersImport;
use App\Exports\MembersExport;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

use PhpParser\Node\Expr\AssignOp\Concat;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function upload(Request $request)
    {    $request->validate([ 'member_list' => 'required|mimes:csv,xlsx,xls|max:4096']);
            Excel::import(new MembersImport, request()->file('member_list'));
            return back()->with('message','File has been uploaded.');

       }

       public function download()
            {
                return Excel::download(new MembersExport, 'members.xlsx');
            }
      public function list(Request $request )
      {


        return [
                'search'=>$request->input('search')?:null,
                'model'=>'member',
                'burl'=>base_path(),

                'members'=>MyPaginator::paginate(MemberResource::collection(Member::query()
                                                                                  ->when($request->input('search'),
                                                                                          fn($query,$search)=>($query->where('name','like','%'.$search.'%')
                                                                                                                     ->orWhere('member_no','like','%'.$search.'%')
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
        //list all members


        return inertia('Member/Index',$this->list($request));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show the create form
        return inertia('Member/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
    //   dd($request->all());
        $member=Member::create($request->only(['name','gender','field','member_no','nationality']));
      //attach contacts

       Contact::create([
                          'contact'=>$request->email,
                          'contact_type'=>'email',
                          'contactable_type'=>'App\Models\Member',
                          'contactable_id'=>$member->id,
                          'default'=>true

                 ]);
       if ($request->has('phone'))
       {
           Contact::create([
                          'contact'=>$request->phone,
                          'contact_type'=>'phone',
                          'contactable_type'=>'App\Models\Member',
                          'contactable_id'=>$member->id,
                          'default'=>true

                         ]);
       }

       User::create([
                            'name'=>$request->name,
                            'email'=>$request->email,
                             'password'=>bcrypt('Rotary'.$request->member_no),
                            'user_type_id'=>2,
                            'authenticatable_type'=>'App\Models\Member',
                            'authenticatable_id'=>$member->id,
                            'phone'=>$request->phone?:''
                        ]);


      return redirect()->route('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function stats($member)
    {
        # code...
        //meetings attended by the member
        return [
                 'meetings'=>$member->scores()->with(['meeting'=>fn($q)=>$q->orderBy('date','desc')])->get(),
               ];


    }
    public function show(Member $member)
    {
        //show the member profile
        // dd($this->stats($member));
        return inertia('Member/Show',array_merge(['member'=>MemberResource::make($member)],$this->stats($member)));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //show the form to edit a member
        return inertia('Member/Edit', ['member'=>MemberResource::make($member)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->contacts()->delete();
        $member->scores()->delete();

        $member->delete();

        return redirect(route('member.index'));
    }
}
