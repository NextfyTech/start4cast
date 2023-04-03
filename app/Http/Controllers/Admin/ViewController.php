<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categorylist;
use App\Models\Admin\StarSignMaster;
use App\Models\Admin\splData;
use Illuminate\Support\Facades\Log;


class ViewController extends Controller
{
    public function index()
    {
        $star_sign_master = StarSignMaster::all();
        $category_list = Categorylist::all();
        return view('admin.category.view', compact('star_sign_master', 'category_list'));
    }


    public function search(Request $request)
    {

        $star_sign_master = StarSignMaster::all();
        $category_list = Categorylist::all();
        $spl_categry_id = $request->get('spl_categry_id');
        $starsign_id = $request->get('starsign_id');
        $data = splData::where('spl_category_id', $spl_categry_id)->where('starsign_id', $starsign_id)->get();
        return view('admin.category.view', compact('data', 'star_sign_master', 'category_list'));
    }

    public function getWeeks(Request $request){
        try {
            $getyear = $request->get('year');
            $weeks = [];
            $date = \Carbon\Carbon::createFromDate($getyear, 1, 1);
            for ($week = 1; $week <= $date->weeksInYear; $week++) {
                $startOfWeek = $date->startOfWeek()->format('m-d-y');
                $endOfWeek = $date->endOfWeek()->format('m-d-y');
                $weeks[$week] = "Week $startOfWeek - Week $endOfWeek";
                $date->addWeek();
            }
            return response()->json(['weeks'=>$weeks]);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
        }
    }

    public function getweeksinweek(Request $request){
        try {
            $getyear = $request->get('year');
            $weeks = [];
            $date = \Carbon\Carbon::createFromDate($getyear, 1, 1);
            for ($week = 1; $week <= $date->weeksInYear; $week++) {
                $startOfWeek = $date->startOfWeek()->format('m-d-y');
                $endOfWeek = $date->endOfWeek()->format('m-d-y');
                $weeks[$date->startOfWeek()->format('yyyy-mm-dd')."#".$date->endOfWeek()->format('yyyy-mm-dd')] = "Week $startOfWeek - Week $endOfWeek";
                $date->addWeek();
            }
            return response()->json(['weeks'=>$weeks]);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
        }
    }
}
