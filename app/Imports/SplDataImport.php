<?php

namespace App\Imports;

use App\Models\Admin\SplData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SplDataImport implements WithHeadingRow, ToModel
{
    /*private $rows = 0;
    public function model(array $row)
    {
        ++$this->rows;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }*/
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $rows)
    {
        foreach ($rows as $row){
            SplData::create([
               'data' => $rows['data_txt'],
               'starsign_id' => $rows['starsign_id']
            ]);
        }
    }
}
