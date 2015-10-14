<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use MartinBean\MenuBuilder\Menu;

class MenuTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$menus = array(
			array( // row #0
				'id' => 1,
				'name' => 'Link',
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #1
				'id' => 2,
				'name' => 'User',
				'created_at' => '2015-05-08 13:39:26',
				'updated_at' => '2015-05-08 13:39:26',
			),
			array( // row #2
				'id' => 3,
				'name' => 'Event',
				'created_at' => '2015-05-12 11:52:26',
				'updated_at' => '2015-05-12 11:52:26',
			),
			array( // row #3
				'id' => 4,
				'name' => 'Arc',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #4
				'id' => 5,
				'name' => 'PlayerCharacter',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #5
				'id' => 6,
				'name' => 'Economy',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #6
				'id' => 8,
				'name' => 'Order',
				'created_at' => '2015-06-19 14:34:31',
				'updated_at' => '2015-06-19 14:34:31',
			),
			array( // row #7
				'id' => 9,
				'name' => 'Crafting',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		);

		foreach($menus as $menu){
			$this->command->info ( 'Creating menu:'.$menu['name']. "... success: ".!empty(Menu::create($menu)));
		}
		$this->command->info ( 'Menu table seeded!' );
	}
}
