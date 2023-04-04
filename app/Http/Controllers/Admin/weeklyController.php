<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\StarSignMaster;
use Illuminate\Support\Carbon;
use Validator;
use App\Models\Admin\StarSignData;
use App\Imports\WeeklyDataImport;
use DateTime;


class weeklyController extends Controller
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

				//add to array
				$lines[]=$line;
            }
			}
			fclose($fp);

            $week = explode(" ",$lines[0]);
			if(isset($week[2])) {
			$week[1] = $week[1]."".$week[2];
			}
			//echo "Date:$week[1]";
			$week=$week[1];
			$week = trim($week);
			$monthf = preg_replace("/[0-9]/", "", $week); // getting month.
			$monthf = strtolower($monthf);
			$monthf = ucfirst($monthf);
			$dateRangeArray = explode(' - ', $request->timePeriod);
			$date_from = substr($dateRangeArray[0], strpos($dateRangeArray[0], ' ') + 1);
			$date_to = substr($dateRangeArray[1], strpos($dateRangeArray[1], ' ') + 1);
			$monthes2=array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");

			//if month in file is in short form.
			$mntharray = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
			if (in_array($monthf, $mntharray)) {
					$temp_month_no = date('m', strtotime($monthf));
					$monthf = $monthes2[$temp_month_no];
				}


		    preg_match_all('!\d+!', $week, $match); //getting date.
			$datefromfile=$match[0][0];
			//extracting month and date from form.
			$dateto1 = explode("-",$date_to);
			$dateto = (int)$dateto1[0];
			$month = $dateto1[0];
			//getting week number from date.
			$ddate = $date_from;
			$date1 = new DateTime($ddate);
			$week1 = $date1->format("W");

          
						//open and read the file
						$newLines=array();
						for ($i = 1 , $j = 0; $i < count($lines); ++$i) {
							$words = explode(" ",$lines[$i]);
							$words[0] = strtoupper($words[0]);

							$sign = array("ARIES", "TAURUS", "GEMINI", "CANCER", "LEO", "VIRGO", "LIBRA", "SCORPIO", "SAGITTARIUS", "CAPRICORN", "AQUARIUS", "PISCES");

							if (in_array($words[0], $sign)) {
									$newlines[$j]=$lines[$i];
									$j++;
								} else {

									$newlines[$j-1]=$newlines[$j-1]."\r\n".$lines[$i];

								   }
						}


						// replacing start and end date with '#'
						for ($i = 0, $j = 0; $i < count($newlines); ++$i,++$j) {
						$newlines[$i] = preg_replace("/([January|February|March|April|May|June|July|August|September|October|November|December]+)(\s+)([0-9]+)(\s+)-(\s+)([January|February|March|April|May|June|July|August|September|October|November|December]+)(\s+)([0-9]+)/", "# ", "$newlines[$i]");
						}


						//separate the sign and content.
						$sign=array();
						$content=array();

						for ($i = 0; $i < count($newlines); ++$i) {
								$words = explode("#",$newlines[$i]);
								$sign[$i]=$words[0];
								$content[$i]=$words[1];

						}

					   $starsign = array("ARIES"=>"1", "TAURUS"=>"2", "GEMINI"=>"3", "CANCER"=>"4", "LEO"=>"5", "VIRGO"=>"6", "LIBRA"=>"7", "SCORPIO"=>"8", "SAGITTARIUS"=>"9", "CAPRICORN"=>"10", "AQUARIUS"=>"11", "PISCES"=>"12");

					   for ($i = 0; $i < count($newlines); ++$i) {
								$temp = $sign[$i];
								$temp=trim($temp);
								$starsign_id = $starsign["$temp"];
							    $data[$i] = $starsign_id."#".$date_from."#".$date_to."#".$content[$i];
							}
                            $newOddArr = $content;
                            $newEvenArr = $sign;
                            $finalArr = array();
                            foreach($newEvenArr as $ke => $val){
                                $finalArr[$val] = $newOddArr[$ke];
                            }
                            foreach ($finalArr as $starSign => $final) {
                                $starsignid = StarSignMaster::where('starsign', ucfirst(strtolower($starSign)))->first();
                                //Log::info($starsignid->id);
                                 $day = Carbon::parse($request->get('day'));
                                 StarSignData::create([
                                     'starsign_id' => $starsignid->starsign_id,
                                     'date_from' => $day,
                                     'date_to' => $day->addDay(),
                                     'data_type' => 'Weekly',
                                     'data_txt' => $final,
                                     'data_from_file' => 'null',
                                     'data_added_date' => Carbon::now()
                                     ]);
        }
        return redirect('/weekly')->with('success', 'Data Added!');
    
    }
    return view('admin.Data_Manager.weekly');
}
}
