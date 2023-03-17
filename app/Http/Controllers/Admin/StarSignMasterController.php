<?php

namespace App\Http\Controllers\Admin;
use Yajra\DataTables\DataTables;
use App\Models\Admin\StarSignMaster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StarSignMasterController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $get_data = StarSignMaster::get();
            return Datatables::of($get_data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.star_sign_master.index');
    }
}
