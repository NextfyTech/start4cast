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
                $monthNumber = 4;
//                $year = date('Y'); // get the current year
                $startDate = \Carbon\Carbon::createFromDate($year, $monthNumber, 1)->startOfMonth();
                $endDate = \Carbon\Carbon::createFromDate($year, $monthNumber, 1)->endOfMonth();

                if (is_null($starsign_id)){
                    $data=StarSignData::where('data_type','monthly')
                        ->where('date_from',Carbon::parse($startDate))->paginate(50);
                }else {
                    $data=StarSignData::where('data_type',strtolower($request->get('data_type')))->where('starsign_id',$request->get('starsign_id'))
                        ->where('date_from',Carbon::parse($startDate))->paginate(50);
                }
//                dd($data);
            }elseif (strtolower($request->get('data_type')) === 'weekly'){

                $dateRangeArray = explode(' - ', $request->get('weekly'));
                $date_from = substr($dateRangeArray[0], strpos($dateRangeArray[0], ' ') + 1);
                $date_to = substr($dateRangeArray[1], strpos($dateRangeArray[1], ' ') + 1);
                $dateFrom = \Carbon\Carbon::createFromFormat('m-d-y', $date_from);
                $formattedDateFrom = Carbon::parse($dateFrom->format('Y-m-d'));
                $dateTo = \Carbon\Carbon::createFromFormat('m-d-y', $date_to);
                $formattedDateTo = Carbon::parse($dateTo->format('Y-m-d'));
                $year  = $request->get('selectedyear');
                $week = $request->get('weekly');
                if (is_null($starsign_id)){
                    $data=StarSignData::where('data_type','weekly')
                        ->where('date_from',$formattedDateFrom)->where('date_to',$formattedDateTo)->paginate(50);
                }else {
                    $data=StarSignData::where('data_type','weekly')->where('starsign_id',$request->get('starsign_id'))
                        ->where('date_from',$formattedDateFrom)->where('date_to',$formattedDateTo)->paginate(50);
                }
            }else {
                $data_type = $request->get('data_type');
                $starsign_id = $request->get('starsign_id') == "Choose..." ? null : $request->get('starsign_id');
                $date = Carbon::parse($request->get('day'));
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
