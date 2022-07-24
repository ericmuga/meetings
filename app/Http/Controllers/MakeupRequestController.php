<?php

namespace App\Http\Controllers;

use App\Models\MakeupRequest;
use App\Http\Requests\StoreMakeupRequestRequest;
use App\Http\Requests\UpdateMakeupRequestRequest;

class MakeupRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return inertia('Makeup/Index');
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
     * @param  \App\Http\Requests\StoreMakeupRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMakeupRequestRequest $request)
    {
        //
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
        //
    }
}
