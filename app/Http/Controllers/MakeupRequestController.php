<?php

namespace App\Http\Controllers;

use App\MyPaginator;
use App\Models\MakeupRequest;
use App\Http\Requests\StoreMakeupRequestRequest;
use App\Http\Requests\UpdateMakeupRequestRequest;
use Illuminate\Http\Request;
use App\Http\Resources\MakeupRequestResource;

class MakeupRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

    public function list(Request $request )
    {


      return [
              'search'=>$request->input('search')?:null,
              'model'=>'makeup',
              'burl'=>base_path(),
            'memberSelect'=>GuestController::buildMemberSelect(),
              'makeups'=>MyPaginator::paginate(MakeupRequestResource::collection(MakeupRequest::query()
                                                                                ->when($request->input('search'),
                                                                                        fn($query,$search)=>($query->where('makeup_date','like','%'.$search.'%')

                                                                                                            )
                                                                                       )
                                                                                      ->orderBy('makeup_date')
                                                                                      ->get()
                                                                              ),$request->input('perPage')?:16,null,['path'=>url()->full()]
                                                                              )->withQueryString()


              ];



    }

    public function index(Request $request)
    {


        return inertia('Makeup/Index', $this->list($request));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMakeupRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMakeupRequestRequest $request)
    {
        MakeupRequest::create([
            'description'=>$request->description,
            'makeup_date'=>$request->date,
            'details'=>$request->detail,
            'category'=>$request->category,
            'member_id'=>$request->member_id,

           ]);

      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MakeupRequest  $makeupRequest
     * @return \Illuminate\Http\Response
     */
    public function show(MakeupRequest $makeupRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MakeupRequest  $makeupRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(MakeupRequest $makeupRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMakeupRequestRequest  $request
     * @param  \App\Models\MakeupRequest  $makeupRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMakeupRequestRequest $request, MakeupRequest $makeupRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MakeupRequest  $makeupRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MakeupRequest $makeupRequest)
    {
      //  dd($makeupRequest);
        $makeupRequest->delete();
        return redirect(Route('makeup.index'));
    }
}
