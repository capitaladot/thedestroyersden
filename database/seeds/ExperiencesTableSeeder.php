<?php

use Illuminate\Database\Seeder;

class ExperienceTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('experiences')->delete();
        
	}

}
