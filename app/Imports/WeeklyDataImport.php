<?php

namespace App\Imports;

use App\Models\Admin\StarSignData;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WeeklyDataImport implements ToModel, WithHeadingRow
{
    public $year_data = '';
    public $week_data = '';
    public function  __construct($data)
    {
        try {
            $this->year_data = $data['year_data'];
            $this->week_data = $data['timePeriod'];
        }catch (\Exception $e){
            Log::alert($e->getMessage());
        }
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $all_year_data = explode('#',$this->year_data);
            return new StarSignData([
                'date_from' => $all_year_data[0],
                'date_to' => $all_year_data[1],
                'data' => $row['data'],
                'starsign_id' => $row['starsign_id'],
                'data_type' => 4,
            ]);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
        }
    }
}
