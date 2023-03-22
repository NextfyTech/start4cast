<?php

namespace App\Imports;

use App\Models\Admin\SplData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SplDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SplData([
            'data'     => $row[0],
            'starsign_id'    => $row[1],
        ]);
    }
}
