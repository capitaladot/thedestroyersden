<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class WeaponTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		
		// $this->call('WeaponTableSeeder');
	}
}
