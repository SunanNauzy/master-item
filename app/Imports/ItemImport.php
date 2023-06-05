<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'bulan'       	  => $row['0'],
            'input_date'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['1']),
            'approval_status' => $row['2'],
            'user'        	  => $row['3'],
            'unit'      	  => $row['4'],
            'qty'      	 	  => $row['5'],
            'jenis_transaksi' => $row['8'],
            'name'       	  => $row['13'],
            'tipe'        	  => $row['6'],
            'kode_barang'     => $row['7'],
            'bidang' 		  => $row['9'],
            'kelompok'        => $row['10'],
            'jenis'      	  => $row['11'],
            'type'        	  => $row['12'],

        ]);
    }
}
