<?php

namespace App\Http\Controllers;

use App\Models\GradingRule;
use App\Http\Requests\StoreGradingRuleRequest;
use App\Http\Requests\UpdateGradingRuleRequest;

class GradingRuleController extends Controller
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
     * @param  \App\Http\Requests\StoreGradingRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradingRuleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function show(GradingRule $gradingRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function edit(GradingRule $gradingRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradingRuleRequest  $request
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradingRuleRequest $request, GradingRule $gradingRule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingRule  $gradingRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingRule $gradingRule)
    {
        //
    }
}
