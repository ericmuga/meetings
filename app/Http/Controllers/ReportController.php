<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                                    ['name'=>'qr codes', 'id'=>8],


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
            case 1:return [
                            ['name'=>'Filter 1','id'=>1,'type'=>'text'],
                            ['name'=>'Filter 2','id'=>2,'type'=>'text'],
                            ['name'=>'Filter 3','id'=>3,'type'=>'DropDown'],
                            ['name'=>'Filter 4','id'=>3,'type'=>'date'],

                          ];
                # code...
                break;

            default:
                # code...
                break;
        }
    }

    public function show(Request $request, $id)
    {

        return inertia('Report/RequestPage',['filters'=>$this->getFilters($id),'name'=>$this->list($id)['name']]);
    }
}
