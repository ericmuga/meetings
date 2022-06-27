<?php

namespace App\Http\Controllers;

use App\Models\GradingRule;
use App\Http\Resources\GradingRuleResource;
use App\Http\Requests\StoreGradingRuleRequest;
use App\Http\Requests\UpdateGradingRuleRequest;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\MyPaginator;

class GradingRuleController extends Controller
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

                'burl'=>base_path(),



                'rules'=>MyPaginator::paginate(GradingRuleResource::collection(GradingRule::query()
                                                            ->when($request->input('search'),fn($query,$search)=>($query->where('name','like','%'.$search.'%')
                                                                                                                     ->orWhere('min_minutes','like','%'.$search.'%')
                                                                                                                     ->orWhere('min_members','like','%'.$search.'%')
                                                                                                                     ->orWhere('meeting_type','like','%'.$search.'%')
                                                                                                                     ->orWhere('start_time','like','%'.$search.'%')

                                                                                                              )
                                                                                         )
                                                                                        ->orderBy('name')
                                                                                        ->get()
                                                                                ,$request->input('perPage')?:16,null,['path'=>url()->full()]))
                                                                                ->withQueryString()


                ];



      }

     public function index(Request $request)
    {
        //list all members


        return inertia('GradingRule/Index',$this->list($request));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('GradingRule/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGradingRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradingRuleRequest $request)
    {
        GradingRule::create($request->all());

        return redirect(route('grading.index'));
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
    public function destroy($id)
    {

         $gradingRule=gradingRule::find($id);
           if(Meeting::where('grading_rule_id',$gradingRule->id)->exists())
           {
             // return 'Rule is being used to grade some meetings';
                return redirect(route('grading.index'));
           }
           else{

          $gradingRule->delete();
            return back();
       }


    }
}
