<?php

namespace App\Imports;

use App\Models\Admin\StarSignData;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DailyDataImport implements ToModel, WithHeadingRow
{
    public $time = '';
    public function  __construct($data)
    {
        try {
            $this->time = $data['day'];
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
            //$time_period = explode('#',$this->time);
            return new StarSignData([
                'date_from' => $this->time,
                'data' => $row['data'],
                'starsign_id' => $row['starsign_id'],
                'data_type' => 1,
            ]);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
        }
    }
}
