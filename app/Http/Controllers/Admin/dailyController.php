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

class dailyController extends Controller
{

    public function index(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $date_to = $date_from = $request->get('day');
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
                // check for right file selection
                $line1 = trim($lines[0]);
                $mth = substr($line1, 0, 3);
                $mth = strtolower($mth);
                $mth = ucfirst($mth);// month of selected file.

                preg_match_all('!\d+!', $line1, $match);
                $date = $match[0][0]; // date of selected file.
                //echo $date;

                //extracting date and month for display.
                $str = $date_to;
                $d = date_parse($str);
                $tempmonth2 = $d["month"];
                $monthes2 = array("1" => "January", "2" => "February", "3" => "March", "4" => "April", "5" => "May", "6" => "June", "7" => "July", "8" => "August", "9" => "September", "10" => "October", "11" => "November", "12" => "December");

                // extracting date and month from date selected.
                $str = $date_to;
                $d = date_parse($str);
                $tempmonth = $d["month"];

                $monthes1 = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");

                if ($date == $d["day"] && $mth === $monthes1["$tempmonth"]) {
                    $datastartindex = 0;
                    for ($i = 1, $j = 0; $i < count($lines); ++$i) {
                        $words = explode(" ", $lines[$i]);
                        $words[0] = strtoupper($words[0]);

                        $sign = array("ARIES", "TAURUS", "GEMINI", "CANCER", "LEO", "VIRGO", "LIBRA", "SCORPIO", "SAGITTARIUS", "CAPRICORN", "AQUARIUS", "PISCES");
                        if (in_array($words[0], $sign)) {
                            $datastartindex = $i;
                            break;
                        }
                    }
                    $day_spacial = '';
                    for ($i = 1; $i < $datastartindex; ++$i) {
                        $day_spacial = $day_spacial . "\r\n" . $lines[$i];
                    }
                    $newLines = array();
                    for ($i = $datastartindex, $j = 0; $i < count($lines); ++$i) {
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

                    $data = array();
                    $starsign = array("ARIES" => "1", "TAURUS" => "2", "GEMINI" => "3", "CANCER" => "4", "LEO" => "5", "VIRGO" => "6", "LIBRA" => "7", "SCORPIO" => "8", "SAGITTARIUS" => "9", "CAPRICORN" => "10", "AQUARIUS" => "11", "PISCES" => "12");
                    for ($i = 0; $i < count($newlines); ++$i) {
                        $temp = $sign[$i];
                        $temp = trim($temp);
                        $starsign_id = $starsign["$temp"];

                        //echo "<br>sign_id::$starsign_id  <br><br>from:$date_from<br>to:$date_to<br>data_type:$type<br>data_text:$content[$i]<br>data_file:$temppath<br><br>";
                        $data[$i] = $starsign_id . "#" . $date_from . "#" . $date_to . "#" . "Daily" . "#" . $content[$i] . "#" . $request->file('csv_file');
                        $sdata[$i] = $starsign_id . "#" . $content[$i];

                    }
                    $datacount = count($newlines);
                    $finalDataArray = [];
                    for ($i = 0; $i < count($newlines); ++$i) {
                        $finalDataArray[] = [$sign[$i] => trim($content[$i])];
                    }
//                    dd($finalDataArray);
                } else {
                    return redirect()->back()->with('fail', 'Please Choose Correct File for the selected date!');
                }
                if ($date == $d["day"]){
                    return view('admin.Data_Manager.preview',['data'=>$finalDataArray,'date_from' => date('Y-m-d H:i:s', strtotime($date_from)) , 'date_to' => date('Y-m-d H:i:s', strtotime($date_to)), 'type' => 'daily']);
//                    return redirect()->route('dataPreview')->with('data',$finalDataArray);
//                    return redirect('/daily')->with('success', 'Data Added!');
                }else {
                    return redirect('/daily')->with('fail', 'Please choose correct file for the selected date!');
                }

            }
            return view('admin.Data_Manager.daily');
        } catch (\Exception $exception) {
            Log::alert($exception->getMessage());
        }
    }


    public function previewData(Request $request){
        try {
            $starSignArr = $request->get('starsign');
            $contentArr = $request->get('content');
            $type = $request->get('data_type');
            $finalArr = array_combine($starSignArr,$contentArr);
            foreach ($finalArr as $key => $value){
                $starsignid = StarSignMaster::where('starsign', ucfirst(strtolower($key)))->first();
                $query = StarSignData::query();
                if ($query->where('date_from',date('Y-m-d H:i:s', strtotime($request->get('date_from'))))->where('starsign_id',$starsignid->starsign_id)->exists()){
                            $query->update([
                                'date_from' => $request->get('date_from'),
                                'starsign_id' => $starsignid->starsign_id,
                                'date_to' => $request->get('date_to'),
                                'data_type' => $type,
                                'data_txt' => $value,
                                'data_from_file' => 'null',
                                'data_added_date' => Carbon::now()
                            ]);
                }else {
                            $query->insert([
                                'date_from' => $request->get('date_from'),
                                'starsign_id' => $starsignid->starsign_id,
                                'date_to' => $request->get('date_to'),
                                'data_type' => $type,
                                'data_txt' => $value,
                                'data_from_file' => 'null',
                                'data_added_date' => Carbon::now()
                            ]);
                }
            }
            return redirect()->route('Data_Manager.view')->with('success','Data Added Successfully!');
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
        }
    }
}
