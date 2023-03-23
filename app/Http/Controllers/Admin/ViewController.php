<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        return view('admin.category.view');
    }

    public function view(){
        $data=Categorylist::all();
        $view=compact('data');
        return redirect('/categorylist')->with($view);

    }
}
