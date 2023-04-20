<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Admin\StarSignMaster;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Admin\StarSignData;
use App\Imports\YearDataImport;

class yearlyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            try {

                $timePeriod = explode("#", $request->get('time_period'));
                $date_from = $timePeriod[0];
                $date_to = $timePeriod[1];
                $validate = $this->validate($request, [
                    'csv_file' => 'required',
                ]);
                $lines = array();
                $lines = array();
                $fp = fopen($request->file('csv_file'), 'r');
                while (!feof($fp)) {
                    $line = fgets($fp);

                    //remove the lweading and trailing white spaces.
                    $line = trim($line);

                    // Ignore the empty lines.
                    if ($line == "") {
                    } else {

                        //add to array
                        $lines[] = $line;
                    }

                }
                fclose($fp);

                $yearstr = explode(" ", $lines[0]);
                $year = $yearstr[0];
                $year = trim($year);

                $year_keyword = $yearstr[1];
                $year_keyword = strtolower("$year_keyword");
                //echo $year_keyword;

                $datestr = explode("-", $date_from);
                $fyear = $datestr[0];
                $fyear = trim($fyear);
//                Log::debug($year);
//                Log::info($fyear);
//                Log::notice($year_keyword);
                if ($year == $fyear || $year_keyword == "yearly" || $year_keyword == "ahead") {
                    //open and read the file
                    $newLines = array();
                    for ($i = 1, $j = 0; $i < count($lines); ++$i) {
                        $words = explode(" ", $lines[$i]);
                        $words[0] = strtoupper($words[0]);

                        $sign = array("ARIES", "TAURUS", "GEMINI", "CANCER", "LEO", "VIRGO", "LIBRA", "SCORPIO", "SAGITTARIUS", "CAPRICORN", "AQUARIUS", "PISCES");

                        if (in_array($words[0], $sign)) {
                            $newlines[$j] = $lines[$i];
                            $j++;
                        } else {

                            $newlines[$j - 1] = $newlines[$j - 1] . "\r\n" . $lines[$i];

                        }
                    }


                    // replacing start and end date with '#'
                    for ($i = 0, $j = 0; $i < count($newlines); ++$i, ++$j) {
                        $newlines[$i] = preg_replace("/([January|February|March|April|May|June|July|August|September|October|November|December]+)(\s+)([0-9]+)(\s+)-(\s+)([January|February|March|April|May|June|July|August|September|October|November|December]+)(\s+)([0-9]+)/", "# ", "$newlines[$i]");
                    }


                    //separate the sign and content.
                    $sign = array();
                    $content = array();

                    for ($i = 0; $i < count($newlines); ++$i) {
                        $words = explode("#", $newlines[$i]);
                        $sign[$i] = $words[0];
                        $content[$i] = $words[1];
                        //$content[$i] = mysql_real_escape_string($content[$i]);#make the text data safe for database operations.

                    }

                    $starsign = array("ARIES" => "1", "TAURUS" => "2", "GEMINI" => "3", "CANCER" => "4", "LEO" => "5", "VIRGO" => "6", "LIBRA" => "7", "SCORPIO" => "8", "SAGITTARIUS" => "9", "CAPRICORN" => "10", "AQUARIUS" => "11", "PISCES" => "12");
                    for ($i = 0; $i < count($newlines); ++$i) {
                        $temp = $sign[$i];
                        $temp = trim($temp);
                        $starsign_id = $starsign["$temp"];
                        $data[$i] = $starsign_id . "#" . $date_from . "#" . $date_to . "#Yearly#" . $content[$i] . "#";
                    }
                    $finalDataArray = [];
                    for ($i = 0; $i < count($newlines); ++$i) {
                        $finalDataArray[] = [$sign[$i] => trim($content[$i])];
                    }
//                    dd($finalDataArray);
                    foreach ($finalDataArray as $key => $value) {
                        foreach ($value as $keys => $item) {
                            $starsignid = StarSignMaster::where('starsign', ucfirst(strtolower($keys)))->first();
                            $query = StarSignData::query();
//                            dd($query->where('date_from',$date_from)->where('data_type','yearly')->get());
                            if ($query->where('date_from',$date_from)->where('data_type','yearly')->where('starsign_id',$starsignid->starsign_id)->exists()){
                                $query->update([
                                    'starsign_id' => $starsignid->starsign_id,
                                    'date_from' => date('Y-m-d H:i:s', strtotime($date_from)),
                                    'date_to' => date('Y-m-d H:i:s', strtotime($date_to)),
                                    'data_type' => 'yearly',
                                    'data_txt' => $item,
                                    'data_from_file' => 'null',
                                    'data_added_date' => Carbon::now()
                                ]);
                            }else {
                                $query->insert([
                                    'starsign_id' => $starsignid->starsign_id,
                                    'date_from' => date('Y-m-d H:i:s', strtotime($date_from)),
                                    'date_to' => date('Y-m-d H:i:s', strtotime($date_to)),
                                    'data_type' => 'yearly',
                                    'data_txt' => $item,
                                    'data_from_file' => 'null',
                                    'data_added_date' => Carbon::now()
                                ]);
                            }
                        }
                    }
                    $datacount = count($newlines);
                } else {
                    return redirect()->back()->with('status', 'failed');
                }
                if ($year == $fyear || $year_keyword == "yearly" || $year_keyword == "ahead"){
                    return redirect('/yearly')->with('success', 'Data Added!');
                }else {
                    return redirect('/yearly')->with('fail', 'Please choose correct file for the selected year!');
                }
//                return redirect('/yearly')->with('success', 'Data Added!');

            } catch (\Exception $e) {
                Log::alert($e->getMessage());
//                Log::debug($e->getTraceAsString());
//                Log::info($e->getLine());
                return redirect()->back()->with('fail', $e->getMessage());
            }
        }
        return view('admin.Data_Manager.yearly');
    }

    public function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
