<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Categorylist extends Controller
{
    public function index()
    {
        return view('admin.category.list');
    }

    public function store(Request $request){
        $request->validate(
            [
             'profile_name'=>'required',
             'image'=>'required',
             'email'=>'required|email',
            
             'PCN'=>'required',
             'ACN'=>'required',
            ]
            );
        
        


        $data=new Categorylist();
        $data->profile_name=$request->input('profile_name');
       
        $data->email=$request->input('email');
        
        $data->save();
        return view('welcome')->with('message','success!');

    }
}
