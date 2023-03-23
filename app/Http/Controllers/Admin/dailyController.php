<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\StarSignData;
use App\Imports\SplDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class dailyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validate = $this->validate($request, [
                'data_upload' => 'required',
            ]);
            StarSignData::create([
                'date_from' => $request->day,
                'data_type' => 'day',
                'data_upload' => Excel::import(new SplDataImport,$request->file('data_upload')),
            ]); 
        }
        return view('admin.Data_Manager.daily');
    }
}
