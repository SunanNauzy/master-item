<?php

use Illuminate\Database\Seeder;
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
//use Illuminate\Database\Seeder;
use App\Models\Bidang;
use App\Models\Kelompok;
use App\Models\Jenis;

class BidangKelompokJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $bidang = Bidang::create(['name' => 'Peralatan Ilmiah, Optikal, dan Instrumentasi']);

        $kelompok = Kelompok::create(['bidang_id' => $bidang->id, 'name' => 'Peralatan Instrumentasi']);

        Jenis::create(['kelompok_id' => $kelompok->id, 'name' => 'Oven Pengering']);
        //Jenis::create(['kelompok_id' => $kelompok->id, 'name' => '']);


        $bidang = Bidang::create(['name' => 'Peralatan Telekomunikasi dan Audio Visual']);

        $kelompok = Kelompok::create(['bidang_id' => $bidang->id, 'name' => 'Peralatan telekomunikasi dan Gawai']);

        Jenis::create(['kelompok_id' => $kelompok->id, 'name' => 'Handy Talky']);
        //Jenis::create(['kelompok_id' => $kelompok->id, 'name' => '']);


    }
}
