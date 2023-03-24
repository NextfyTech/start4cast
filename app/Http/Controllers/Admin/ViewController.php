<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;
use App\Models\Admin\StarSignMaster;
use App\Models\Admin\splData;



class ViewController extends Controller
{
    public function index()
    {
        $star_sign_master = StarSignMaster::all();
        $category_list = Categorylist::all();
        return view('admin.category.view',compact('star_sign_master','category_list'));

    }

    
    public function search(Request $request){
        $star_sign_master = StarSignMaster::all();
        $category_list = Categorylist::all();
            $spl_categry_id = $request->get('spl_categry_id');
            $starsign_id = $request->get('starsign_id');
        $data=splData::where('spl_category_id',$spl_categry_id)->where('starsign_id',$starsign_id)->get();
        return view('admin.category.view',compact('data','star_sign_master','category_list'));
       
       }
}
