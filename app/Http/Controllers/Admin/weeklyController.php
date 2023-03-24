<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Admin\StarSignData;
use App\Imports\WeeklyDataImport;

class weeklyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            
            $validate = $this->validate($request, [
                'csv_file' => 'required',
            ]);
            Excel::import(new WeeklyDataImport($request->all()),$request->file('csv_file'));
            return redirect('/weekly')->with('success', 'Data Added!');
        }
        return view('admin.Data_Manager.weekly');
    }
}
