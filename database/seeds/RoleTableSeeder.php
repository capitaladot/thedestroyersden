<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Models\Role;
class RoleTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Role::unguard ();
		$roles = array(
			array( // row #0
				'id' => 1,
				'name' => 'admin',
				'slug' => 'admin',
				'description' => 'Site Administrator',
				'level' => 9,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #1
				'id' => 2,
				'name' => 'user',
				'slug' => 'user',
				'description' => 'Site User',
				'level' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #2
				'id' => 99,
				'name' => 'guest',
				'slug' => 'guest',
				'description' => 'Unauthenticated User',
				'level' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		);
		foreach($roles as $role){
			Log::info('Creating role: '.$role['name'],[$role]);
			Role::create($role);
		}
	}
}
