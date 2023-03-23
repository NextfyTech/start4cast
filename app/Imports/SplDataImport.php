<?php

namespace App\Imports;

use App\Models\Admin\SplData;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SplDataImport implements ToModel, WithHeadingRow
{
    public $time = '';
    public $spclCategoryId = '';
    public function  __construct($data)
    {
        try {
            $this->time = $data['timePeriod'];
            $this->spclCategoryId = $data['spl_category_id'];
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
            $time_period = explode('#',$this->time);
            return new SplData([
                'spl_category_id' => $this->spclCategoryId,
                'spl_date_from' => $time_period[0],
                'spl_date_to' => $time_period[1],
                'data' => $row['data'],
                'starsign_id' => $row['starsign_id']
            ]);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
        }
    }
}
