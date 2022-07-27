<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    //
    public function list($id=null)
    {

                 $reportList= [
                                    ['name'=>'members', 'id'=>1],
                                    ['name'=>'guests', 'id'=>2],
                                    ['name'=>'meetings', 'id'=>3],
                                    ['name'=>'inductees', 'id'=>4],
                                    ['name'=>'zoom meetings', 'id'=>5],
                                    ['name'=>'member attendance', 'id'=>6],
                                    ['name'=>'guest attendance', 'id'=>7],
                                    // ['name'=>'qr codes', 'id'=>8],
                             ];

                  if (!$id) return $reportList;
                  else
                  return $reportList[$id-1];

        }

    public function index()
    {
        return inertia('Report/Index',['reports'=>$this->list()]);
    }


    public function getFilters($id)
    {
        switch ($id) {
            case 1: //get column names and type except ID
                        $columnlist=[];
                        $columns= DB::getSchemaBuilder()->getColumnListing('members');
                        foreach ($columns as $column)
                        {
                            // if (!$column=='gender')
                           $columnlist[$column]=DB::getSchemaBuilder()->getColumnType('members',$column);
                        }
                        dd($columnlist);
                break;

            default:
                # code...
                break;
        }


    }

    public function show(Request $request, $id)
    {
        return inertia('Report/RequestPage',[
                                               'filters'=>$this->getFilters($id),
                                               'name'=>$this->list($id)['name']
                                            ]
                      );
    }
}
