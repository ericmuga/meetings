<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use Illuminate\Http\Request;
use App\MyPaginator;
use App\Http\Resources\ClubResource;

class ClubController extends Controller
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
              'model'=>'club',
              'burl'=>base_path(),

              'clubs'=>MyPaginator::paginate(ClubResource::collection(Club::query()
                                                                                ->when($request->input('search'),
                                                                                        fn($query,$search)=>($query->where('name','like','%'.$search.'%')

                                                                                                            )
                                                                                       )
                                                                                      ->orderBy('name')
                                                                                      ->get()
                                                                              ),$request->input('perPage')?:20,null,['path'=>url()->full()]
                                                                              )->withQueryString()


              ];



    }

    public function index(Request $request)
    {
        // dd($this->list($request));

        return inertia('Club/Index', $this->list($request));
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
     * @param  \App\Http\Requests\StoreClubRequest  $request
     * @return \Illuminate\Http\Response
     *
     *
     *  Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('area')->nullable();
            $table->timestamps();
        });
     */
    public function store(StoreClubRequest $request)
    {
        Club::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'area'=>$request->area,


     ]);

      return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClubRequest  $request
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClubRequest $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        if ($club->guests()->count()==0)
        {
           $club->delete();
           return back();
        }
    }
}
