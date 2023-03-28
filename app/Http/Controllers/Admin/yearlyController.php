<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                $date_from = "2014-06-01 00:00:00";
                $date_to = "08";
                $year = $yearstr[0];
                $year = trim($year);
                $year_keyword = $yearstr[1];
                $year_keyword = strtolower("$year_keyword");
                $datestr = explode("-", $date_from);
                $fyear = $datestr[0];
                $fyear = trim($fyear);
                $newLines = array();
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
                            'id' => $starsign_id,
                            'date_from' => $date_from,
                            'date_to' => $date_to,
                            'content' => $content[$i]
                        ];
                    }
                }
                if(isset($data)){
                    foreach ($data as $starSign => $final) {
                        $finalString = $this->clean($final['content']);
                        StarSignData::create([
                            'starsign_id' => $final['id'],
                            'date_from' => $final['date_from'],
                            'date_to' => Carbon::parse(date('y-m-d')),
                            'data_type' => 'yearly',
                            'data_txt' => $finalString,
                            'data_from_file' => 'null',
                            // 'data_added_date' => 'hjafgj'
                        ]);
                        return redirect('/yearly')->with('success', 'Data Added!');
                    }
                }
            }catch (\Exception $e){
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
