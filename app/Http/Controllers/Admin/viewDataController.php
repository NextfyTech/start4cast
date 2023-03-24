<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;
use App\Models\Admin\StarSignMaster;
use App\Models\Admin\splData;

class viewDataController extends Controller
{
    public function index()

    {
        $star_sign_master = StarSignMaster::all();
       
        return view('admin.Data_Manager.view',compact('star_sign_master'));
        return view('admin.Data_Manager.view');
    }

    public function search(Request $request){
        
        $star_sign_master = StarSignMaster::all();
        $star_sign_data=StarSignData::all();
        $data_type = $request->get('data_type');
        $starsign_id = $request->get('starsign_id');
        $data=splData::where('data_type',$data_type)->where('starsign_id',$starsign_id)->get();
        
        return view('admin.Data_Manager.view',compact('data','star_sign_master','data_type'));
       }

}
