<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;
use App\Models\Admin\StarSignMaster;
use App\Models\Admin\StarSignData;
use App\Models\Admin\splData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class viewDataController extends Controller
{
    public function index()

    {
        $star_sign_master = StarSignMaster::all();
        return view('admin.Data_Manager.view',compact('star_sign_master'));
    }

    public function search(Request $request){
        try {
            $starsign_id = $request->get('starsign_id') == "Choose..." ? null : $request->get('starsign_id');
            if (strtolower($request->get('data_type')) === 'yearly'){
                if (is_null($starsign_id)){
                    $data=StarSignData::where('data_type','yearly')
                        ->whereYear('date_from', $request->get('selectedyear'))
                        ->whereYear('date_to', $request->get('selectedyear'))
                        ->paginate(50);
                }else {
                    $data=StarSignData::where('data_type','yearly')->where('starsign_id',$request->get('starsign_id'))
                        ->whereYear('date_from', $request->get('selectedyear'))
                        ->whereYear('date_to', $request->get('selectedyear'))
                        ->paginate(50);
                }
            }elseif (strtolower($request->get('data_type')) === 'monthly'){
                $year  = $request->get('selectedyear');
                $month = $request->get('month');
                if (is_null($starsign_id)){
                    $data=StarSignData::where('data_type','monthly')
                        ->whereYear('date_from', $year)
                        ->whereMonth('date_from', $month)
                        ->whereYear('date_to', $year)
                        ->whereMonth('date_to', $month)
                        ->paginate(50);
                }else {
                    $data=StarSignData::where('data_type',strtolower($request->get('data_type')))->where('starsign_id',$request->get('starsign_id'))
                        ->whereYear('date_from', $year)
                        ->whereMonth('date_from', $month)
                        ->whereYear('date_to', $year)
                        ->whereMonth('date_to', $month)
                        ->paginate(50);
                }
            }elseif (strtolower($request->get('data_type')) === 'weekly'){
                $year  = $request->get('selectedyear');
                $week = $request->get('weekly');
                if (is_null($starsign_id)){
                    $data=StarSignData::where('data_type','weekly')
                        ->whereRaw('YEAR(date_from) = ?', [$year])
                        ->whereRaw('YEAR(date_to) = ?', [$year])
                        ->whereRaw('WEEK(date_from) = ?', [$week])
                        ->whereRaw('WEEK(date_to) = ?', [$week])
                        ->paginate(50);
                }else {
                    $data=StarSignData::where('data_type','weekly')->where('starsign_id',$request->get('starsign_id'))
                        ->whereRaw('YEAR(date_from) = ?', [$year])
                        ->whereRaw('YEAR(date_to) = ?', [$year])
                        ->whereRaw('WEEK(date_from) = ?', [$week])
                        ->whereRaw('WEEK(date_to) = ?', [$week])
                        ->paginate(50);
                }
            }else {
                $data_type = $request->get('data_type');
                $starsign_id = $request->get('starsign_id') == "Choose..." ? null : $request->get('starsign_id');
                $date = Carbon::createFromFormat('Y-m-d', $request->get('date'));
                if (is_null($starsign_id)){
                    $data=StarSignData::where('data_type',strtolower($data_type))->where('date_from',$date->startOfDay())->get();
                }else {
                    $data=StarSignData::where('data_type',strtolower($data_type))->where('starsign_id',$request->get('starsign_id'))->where('date_from',$date->startOfDay())->get();
                }
            }
            $star_sign_master = StarSignMaster::all();
            return view('admin.Data_Manager.view',compact('data','star_sign_master'));
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return back();
        }
       }

}
