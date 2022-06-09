<?php

namespace App\Http\Controllers;

use App\Models\LogSetup;
use App\Http\Requests\StoreLogSetupRequest;
use App\Http\Requests\UpdateLogSetupRequest;

class LogSetupController extends Controller
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
     * @param  \App\Http\Requests\StoreLogSetupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLogSetupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogSetup  $logSetup
     * @return \Illuminate\Http\Response
     */
    public function show(LogSetup $logSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogSetup  $logSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(LogSetup $logSetup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLogSetupRequest  $request
     * @param  \App\Models\LogSetup  $logSetup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLogSetupRequest $request, LogSetup $logSetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogSetup  $logSetup
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogSetup $logSetup)
    {
        //
    }
}
