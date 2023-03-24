<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;



class CategorylistController extends Controller
{
    public function index()
    {
        $data= Categorylist::get();
        
        
        return view('admin.category.list',compact('data'));
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
      
       return redirect("/categorylist")->with('success', 'Add Data Successfully');

    }

  
       
    public function edit($spl_category_id)
    {
        $data =  Categorylist::where('spl_category_id',$spl_category_id)->first();
        dd($data);
        return view('admin.category.edit', compact('data'));
    }
  


    public function update(Request $request, $spl_category_id)
    {
        $updateData = $request->validate([
            'spl_category'=> 'required',
        ]);
        Categorylist::where('spl_category_id',$spl_category_id)->update([
            'spl_category' => $request->get('spl_category')
        ]);
        return redirect('/categorylist')->with('success','data Updated Successfully');
    }


    public function delete(Request $request, $spl_category_id)
    {
        $res=Categorylist::where('spl_category_id',$spl_category_id)->delete();
        return redirect('/categorylist')->with('success', 'stock deleted Successfully!.');
    }
}
