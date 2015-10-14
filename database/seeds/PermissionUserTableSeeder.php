<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\PermissionUser;
class PermissionUserTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permission_user')->delete();
        
	}

}
