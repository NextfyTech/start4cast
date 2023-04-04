<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
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
                $validate = $this->validate($request, [
                    'csv_file' => 'required',
                ]);
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
                $dataArray = explode("#",$request->get('time_period'));
                $date_from = $dataArray[0];
                $date_to = $dataArray[0];
                $year = $yearstr[0];
                $year = trim($year);
                $year_keyword = $yearstr[1];
                $year_keyword = strtolower("$year_keyword");
                $datestr = explode("-", $date_from);
                $fyear = $datestr[0];
                $fyear = trim($fyear);
                $newLines = array();
//                Log::debug($date_from);
//                Log::notice($date_to);
//                Log::info($year);
//                dd($request->get('time_period'));
                if ($year_keyword == "yearly") {
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
                        $data[] = [
                            'starsign_id' => $starsign_id,
                            'data_type' => 'yearly',
                            'date_from' => $date_from,
                            'date_to' => $date_to,
                            'data_txt' => $content[$i],
                            'data_from_file' => 'null',
                        ];
                    }
                }
                foreach ($data as $datum){
                    StarSignData::insert([
                        'starsign_id' => $datum['starsign_id'],
                        'data_type' => $datum['data_type'],
                        'date_from' => $datum['date_from'],
                        'date_to' => $datum['date_to'],
                        'data_txt' => $this->clean($datum['data_txt']),
                        'data_from_file' => $datum['data_from_file'],
                    ]);
                }
            }catch (\Exception $e){
                Log::alert($e->getMessage());
                Log::debug($e->getTraceAsString());
                Log::info($e->getLine());
                return redirect()->back();
            }
        }
        return view('admin.Data_Manager.yearly');
    }

   public function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
