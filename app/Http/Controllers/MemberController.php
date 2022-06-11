<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;
use App\MyPaginator;
use App\Http\Resources\MemberResource;

class MemberController extends Controller
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
                'model'=>'member',
                'burl'=>base_path(),

                'members'=>MyPaginator::paginate(MemberResource::collection(Member::query()
                                                                                  ->when($request->input('search'),
                                                                                          fn($query,$search)=>($query->where('name','like','%'.$search.'%')
                                                                                                                ->orWhere('phone','like',$search.'%')
                                                                                                                ->orWhere('email','like',$search.'%')
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
    dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
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
        //
    }
}
