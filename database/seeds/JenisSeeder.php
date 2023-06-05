<?php

use Illuminate\Database\Seeder;
class JenisSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$temp = array(
			array('name' => 'Backdrop', 'kelompok_id' => '5'),
		);
        $temp1 = array(
           array('name' => 'Stylus Pen', 'kelompok_id' => '6'),
        );

		DB::table('Jenis')->insert($temp);
        DB::table('Jenis')->insert($temp1);
	}

}
