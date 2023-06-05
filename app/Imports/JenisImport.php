<?php

namespace App\Imports;

use App\Models\Jenis;
use Maatwebsite\Excel\Concerns\ToModel;

class JenisImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Jenis([
            'name'       	  => $row['1'],
            'value_kelompok'  => $row['3'],
            'value_bidang'    => $row['2'],
            'value_jenis'     => $row['0']
        ]);
    }
}
