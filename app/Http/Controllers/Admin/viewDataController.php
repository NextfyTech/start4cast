<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;
use App\Models\Admin\StarSignMaster;
use App\Models\Admin\StarSignData;
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
       
        $data_type = $request->get('data_type');
        $starsign_id = $request->get('starsign_id');
        $data=StarSignData::where('data_type',strtolower($data_type))->get();
        $data=splData::where('starsign_id',$starsign_id)->get();
        
        return view('admin.Data_Manager.view',compact('data','star_sign_master'));
       }

}
