<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ApiItemController extends Controller
{
  public function getAllItem(Request $request)
  {

    // $date = explode(" - ", request()->input('from-to', ""));

    // if(count($date) != 2)
    // {
    //     $date = [now()->subDays(29)->format("Y-m-d"), now()->format("Y-m-d")];
    // }


    //$item = Item::latest()->get();
    //$item = Item::whereBetween('input_date', [$date[0], $date[1]])->get();

    if ($request->ajax()) {
        $data = Item::select('*');

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $data = $data->whereBetween('input_date', [$request->from_date, $request->to_date]);
        }

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('created_at', function ($row) {
                        return date('d/m/Y h:i A', strtotime($row->created_at));
                    })
                    ->addColumn('actions', function($row){

                            //$btn = ' <a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            $btn = ' <a target="_blank" class="btn btn-primary btn-sm float-left w-50 " href="/item/' . $row->id . '/edit"><i class="fas fa-pen-square"></i> Edit</a>';
                            return $btn;
                    })
                    ->rawColumns(['actions', 'created_at'])
                    ->make(true);


    }

    return view('/');

    // return  DataTables::of($item)
    //   ->addIndexColumn()
    //   ->addColumn('created_at', function ($row) {
    //     return date('d/m/Y h:i A', strtotime($row->created_at));
    //   })
    //   ->addColumn('actions', function ($row) {
    //     $btns = ' <a hidden target="_blank" class="btn btn-info float-left  btn-sm w-50 " href="/item/' . $row->id . '" ><i class="fas fa-eye"></i> View</a>
    //               <a target="_blank" class="btn btn-primary btn-sm float-left w-50 " href="/item/' . $row->id . '/edit"><i class="fas fa-pen-square"></i> Edit</a>';
    //     return $btns;
    //   })
    //   ->rawColumns(['actions', 'created_at'])
    //   ->make(true);
  }
}
