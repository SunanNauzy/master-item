<?php

namespace App\Imports;

use App\Models\Bidang;
use Maatwebsite\Excel\Concerns\ToModel;

class BidangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bidang([
            'name'       	  => $row['1'],
            'value_bidang'    => $row['0']
        ]);
    }
}
