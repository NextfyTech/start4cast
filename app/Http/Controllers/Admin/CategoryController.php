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

        if ($request->isMethod('post')) {
            $validate = $this->validate($request, [
                'spl_category_id' => 'required',
            ]);
            $time_period = explode('#', $request->timePeriod);
//            $import = new SplDataImport;
            Excel::import(new SplDataImport,$request->file('csv_file'));
//            $path = $request->file('csv_file')->getRealPath();
//            $path1 = $request->file('csv_file')->store('temp');
//            $path=storage_path('app').'/'.$path1;
//            $data = Excel::import(new SplDataImport,$path);
//            dd($data);
//            $spl_data = new SplData();
//            $spl_data->spl_category_id = $request->spl_category_id;
//            $spl_data->spl_date_from = $time_period[0];
//            $spl_data->spl_date_to = $time_period[1];
//            $spl_data->data = "sjkhskjhksjghkjsgh";
//            dd($request->file('csv_file'));
//            $request->file('csv_file')->store('/uploads/csv');
//            dd($request->file('csv_file')->getClientOriginalExtension());
//            Excel::import(new SplDataImport(),$request->file('csv_file.csv'));
//            $spl_data->save();
            return redirect('/category')->with('success', 'Data Added!');
        }
        return view('admin.category.add', compact('spl_category'));
    }
}
