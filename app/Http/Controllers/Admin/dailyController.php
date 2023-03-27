<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            $lines=array();
            $fp=fopen($request->file('csv_file'), 'r');
         while (!feof($fp))
           {
            $line=fgets($fp);
            //remove the lweading and trailing white spaces.
            $line=trim($line);
           // Ignore the empty lines.
           if($line=="") {
            
           }else {
            $lines[]= $line;
            }
        }
        fclose($fp);
        $newOddArr = array();
        $newEvenArr = array();
        $finalArr = array();
        foreach($lines as $key => $newLine){
            if($key%2 != 0){
                $newOddArr[] = $newLine;
            } else {
                $newEvenArr[] = $newLine;
            }
        }
        foreach($newEvenArr as $ke => $val){
            $finalArr[$val] = $newOddArr[$ke];
        }
        foreach($finalArr as $final){
        StarSignData::create([
            'starsign_id' => $final['newEvenArr'],
            'date_to' => $request->day,
            'data_type' => 1,
        ]);
    }
        return redirect('/daily')->with('success', 'Data Added!');
        }
        return view('admin.Data_Manager.daily');
    }
}
