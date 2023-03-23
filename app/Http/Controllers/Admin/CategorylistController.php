<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;

class CategorylistController extends Controller
{
    public function index()
    {
        return view('admin.category.list');
    }

    public function store(Request $request){
        $request->validate(
            [
             'spl_category'=>'required',
             
            ]
            );
        
        


        $data=new Categorylist();
       
        $data->	spl_category=$request->input('spl_category');
        
        $data->save();
      
       return redirect("/categorylist")->with('msg', 'success');

    }
}
