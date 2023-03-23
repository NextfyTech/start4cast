<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Admin\SplCategories;
use App\Models\Admin\SplData;
use App\Imports\SplDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;


class CategoryController extends Controller
{
    public function data_index(Request $request)
    {
        $spl_category = SplCategories::all();
        if ($request->isMethod('post')) 
        {
            $validate = $this->validate($request, [
            'spl_category_id' => 'required',

        ]);
        //$time_period = implode(',', $request->timePeriod);
        
        $spl_data = new SplData();
        $spl_data->spl_category_id = $request->spl_category_id;
        // $spl_data->spl_date_from = explode(" ", $request->timePeriod[0]);
        // $spl_data->spl_date_to = explode(" ", $request->timePeriod[1]);
        $spl_data->spl_date_from = $request->timePeriod;
        $spl_data->spl_date_to = $request->timePeriod;
        Excel::import(new SplDataImport, $request->file('csv_file'));
        $spl_data->save();
        return redirect('/category')->with('success', 'Data Added!');
        }
        return view('admin.category.add',compact('spl_category'));
    }
}
