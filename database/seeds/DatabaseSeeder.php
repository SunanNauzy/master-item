<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Eloquent::unguard();

		// $this->call('UserTableSeeder');
		// $this->call('BidangSeeder');
		// $this->command->info('####### Tabel provinsi berhasil terisi! #######');
		// $this->call('KelompokSeeder');
		// $this->command->info('####### Tabel kabupaten berhasil terisi! #######');
		// $this->call('JenisSeeder');
		// $this->command->info('####### Tabel kecamatan berhasil terisi! #######');
		$this->call('BidangKelompokJenisSeeder');

    }
}
