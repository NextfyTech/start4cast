<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;
use App\Models\Admin\StarSignMaster;



class ViewController extends Controller
{
    public function index()
    {
        $star_sign_master = StarSignMaster::all();
        $category_list = Categorylist::all();
        return view('admin.category.view',compact('star_sign_master','category_list'));

    }

    
}
