<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SplCategories;
use App\Imports\SplDataImport;
use Maatwebsite\Excel\Facades\Excel;


class CategoryController extends Controller
{
    public function data_index(Request $request)
    {
        $spl_category = SplCategories::all();
        if ($request->isMethod('post')) {
            $validate = $this->validate($request, [
                'spl_category_id' => 'required',
            ]);
            // dd($request->file('csv_file'));
            Excel::import(new SplDataImport($request->all()),$request->file('csv_file'));
            return redirect('/category')->with('success', 'Data Added!');
        }
        return view('admin.category.add', compact('spl_category'));
    }
}
