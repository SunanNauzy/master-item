<?php

use Illuminate\Database\Seeder;
class KelompokSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$temp = array(
			array('name' => 'Furnitur Lainnya', 'bidang_id' => '4'),

		);
        $temp1 = array(
			array('name' => 'Peripheral dan Komponen Komputer', 'bidang_id' => '5'),

		);

		DB::table('kelompoks')->insert($temp);
        DB::table('kelompoks')->insert($temp1);
	}

}
