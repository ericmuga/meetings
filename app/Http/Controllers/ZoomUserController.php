<?php

namespace App\Http\Controllers;

use App\Models\ZoomUser;
use App\Http\Requests\StoreZoomUserRequest;
use App\Http\Requests\UpdateZoomUserRequest;

class ZoomUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreZoomUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZoomUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZoomUser  $zoomUser
     * @return \Illuminate\Http\Response
     */
    public function show(ZoomUser $zoomUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZoomUser  $zoomUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ZoomUser $zoomUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZoomUserRequest  $request
     * @param  \App\Models\ZoomUser  $zoomUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZoomUserRequest $request, ZoomUser $zoomUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZoomUser  $zoomUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZoomUser $zoomUser)
    {
        //
    }
}
