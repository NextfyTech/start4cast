<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\StarSignMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\StarSignData;
use App\Imports\DailyDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Validator;

class dailyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $validate = $this->validate($request, [
                'csv_file' => 'required',
            ]);
            $lines = array();
            $fp = fopen($request->file('csv_file'), 'r');
            while (!feof($fp)) {
                $line = fgets($fp);
                $line = trim($line);
                if ($line == "") {

                } else {
                    $lines[] = $line;
                }
            }
            fclose($fp);
            $newOddArr = array();
            $newEvenArr = array();
            $finalArr = array();
            foreach ($lines as $key => $newLine) {
                if ($key % 2 != 0) {
                    $newOddArr[] = $newLine;
                } else {
                    $newEvenArr[] = $newLine;
                }
            }
            foreach ($newEvenArr as $ke => $val) {
                $finalArr[$val] = $newOddArr[$ke];
            }
            foreach ($finalArr as $starSign => $final) {
                $starsignid = StarSignMaster::where('starsign', ucfirst(strtolower($starSign)))->first();
                $day = Carbon::parse($request->get('day'));
                StarSignData::create([
                    'starsign_id' => $starsignid->id,
                    'date_from' => $day,
                    'date_to' => $day->addDay(),
                    'data_type' => 'daily',
                    'data_txt' => $final,
                    'data_from_file' => 'null',
                    'data_added_date' => Carbon::now()
                ]);
            }
            return redirect('/daily')->with('success', 'Data Added!');
        }
        return view('admin.Data_Manager.daily');
    }
}
