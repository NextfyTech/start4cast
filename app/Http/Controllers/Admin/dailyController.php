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
        $fileName = '';
        if ($request->isMethod('post')) {
            $validate = $this->validate($request, [
                'csv_file' => 'required',
            ]);
            // if ($request->hasFile('csv_file')) {

            //     $files = $request->file('csv_file');        

            //     $extension = $files->getClientOriginalExtension();

            //     $fileName =  Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;

            //     $publicUserDocPath = public_path().'/admin/doc/daily/';

            //     $files->move($publicUserDocPath , $fileName);   
            // }
            $lines=array();
            $fp=fopen($request->csv_file, 'r');
         while (!feof($fp))
           {
            $line=fgets($fp);
            //remove the lweading and trailing white spaces.
            $line=trim($line);
           // Ignore the empty lines.
           if($line=="") { 
           }else {
            
            //add to array
            $lines[]=$line;}
        
        }
        fclose($fp);

        // check for right file selection
			$line1=trim($lines[0]);
			
			preg_match_all('!\d+!', $line1, $match);
			$date=$match[0]; // date of selected file.

            Log::info($date);
            
            //Excel::import(new DailyDataImport($request->all()),$request->file('csv_file'));
            
            return redirect('/daily')->with('success', 'Data Added!');
        }
        return view('admin.Data_Manager.daily');
    }
}
