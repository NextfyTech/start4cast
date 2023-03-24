<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\StarSignData;
use App\Imports\DailyDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class dailyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            
            $validate = $this->validate($request, [
                'csv_file' => 'required',
            ]);
            Excel::import(new DailyDataImport($request->all()),$request->file('csv_file'));
            
            return redirect('/daily')->with('success', 'Data Added!');
        }
        return view('admin.Data_Manager.daily');
    }
}
