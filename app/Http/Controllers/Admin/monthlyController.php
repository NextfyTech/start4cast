<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\StarSignMaster;
use Illuminate\Support\Carbon;
use Validator;
use App\Models\Admin\StarSignData;
use App\Imports\DailyMonthlyImport;

class monthlyController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->isMethod("post")) {
                $timePeriod = explode("#", $request->get('month_data'));
                $date_from = $request->get('year_data') . "-" . $timePeriod[0];
                $date_to = $request->get('year_data') . "-" . $timePeriod[1];
//                dd($date_to);
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
                $monthes = array("January" => "01", "February" => "02", "March" => "03", "April" => "04", "May" => "05", "June" => "06", "July" => "07", "August" => "08", "September" => "09", "October" => "10", "November" => 11, "December" => "12");
                //print $lines[0];
                $month = explode(" ", $lines[0]);
                $month1 = ucfirst((strtolower($month[0])));


                $fromonth = explode("-", $date_from);
                if ($fromonth[1] == $monthes["$month1"]) {
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

                        $data[$i] = $starsign_id . "#" . $date_from . "#" . $date_to . "#monthly#" . $content[$i] . "#";
                    }

                    $finalDataArray = [];
                    for ($i = 0; $i < count($newlines); ++$i) {
                        $finalDataArray[] = [$sign[$i] => trim($content[$i])];
                    }

                    foreach ($finalDataArray as $key => $value) {
                        foreach ($value as $keys => $item) {
                            $starsignid = StarSignMaster::where('starsign', ucfirst(strtolower($keys)))->first();
                            $query = StarSignData::query();
                            if ($query->where('starsign_id', $starsignid->starsign_id)->where('data_type', 'monthly')->where('date_from', date('Y-m-d H:i:s', strtotime($date_from)))) {
                                $query->update([
                                    'starsign_id' => $starsignid->starsign_id,
                                    'date_from' => date('Y-m-d H:i:s', strtotime($date_from)),
                                    'date_to' => date('Y-m-d H:i:s', strtotime($date_to)),
                                    'data_type' => 'monthly',
                                    'data_txt' => $item,
                                    'data_from_file' => 'null',
                                    'data_added_date' => Carbon::now()
                                ]);
                            } else {
                                $query->insert([
                                    'starsign_id' => $starsignid->starsign_id,
                                    'date_from' => date('Y-m-d H:i:s', strtotime($date_from)),
                                    'date_to' => date('Y-m-d H:i:s', strtotime($date_to)),
                                    'data_type' => 'monthly',
                                    'data_txt' => $item,
                                    'data_from_file' => 'null',
                                    'data_added_date' => Carbon::now()
                                ]);
                            }
                        }
                    }
                    $datacount = count($newlines);
                }
                if ($fromonth[1] == $monthes["$month1"]){
                     return view('admin.Data_Manager.preview',['data'=>$finalDataArray,'date_from' => date('Y-m-d H:i:s', strtotime($date_from)) , 'date_to' => date('Y-m-d H:i:s', strtotime($date_to))]);
                }else {
                    return redirect('/monthly')->with('error', 'Please choose correct file for the selected year!');
                }
            }
            return view('admin.Data_Manager.monthly');
        } catch (\Exception $exception) {
            Log::alert($exception->getMessage());
        }
    }
}
