<?php

use Illuminate\Database\Seeder;
class BidangSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$temp = array(
            array('name' => 'Furnitur'),
            array('name' => 'Aksesoris Komputer (Non Aset)')
        );
		DB::table('bidangs')->insert($temp);
	}

}
