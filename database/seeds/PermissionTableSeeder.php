<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permissions')->delete();
        
		\DB::table('permissions')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'edit.users',
				'slug' => 'edit.users',
				'description' => NULL,
				'model' => 'App\\User',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'edit.events',
				'slug' => 'edit.events',
				'description' => NULL,
				'model' => 'App\\Event',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'edit.arcs',
				'slug' => 'edit.arcs',
				'description' => NULL,
				'model' => 'App\\Arc',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'create.arcs',
				'slug' => 'create.arcs',
				'description' => NULL,
				'model' => 'App\\Arc',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'create.events',
				'slug' => 'create.events',
				'description' => NULL,
				'model' => 'App\\Event',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'delete.events',
				'slug' => 'delete.events',
				'description' => NULL,
				'model' => 'App\\Event',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'delete.arcs',
				'slug' => 'delete.arcs',
				'description' => NULL,
				'model' => 'App\\Arc',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
