<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SpellTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
	}

}
