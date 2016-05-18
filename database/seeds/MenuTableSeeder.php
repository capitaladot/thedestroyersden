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
			array( 
				'id' => 1,
				'name' => 'Rule',
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( 
				'id' => 2,
				'name' => 'User',
				'created_at' => '2015-05-08 13:39:26',
				'updated_at' => '2015-05-08 13:39:26',
			),
			array( 
				'id' => 3,
				'name' => 'Event',
				'created_at' => '2015-05-12 11:52:26',
				'updated_at' => '2015-05-12 11:52:26',
			),
			array( 
				'id' => 4,
				'name' => 'Arc',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 5,
				'name' => 'PlayerCharacter',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( 
				'id' => 6,
				'name' => 'Economy',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( 
				'id' => 8,
				'name' => 'Order',
				'created_at' => '2015-06-19 14:34:31',
				'updated_at' => '2015-06-19 14:34:31',
			),
			array( 
				'id' => 9,
				'name' => 'Item',
				'created_at' => '2015-06-19 14:34:31',
				'updated_at' => '2015-06-19 14:34:31',
			),
			array( 
				'id' => 10,
				'name' => 'Crafting',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 11,
				'name' => 'Skill',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 12,
				'name' => 'Weapon',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 13,
				'name' => 'Tool',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 14,
				'name' => 'Consumable',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 15,
				'name' => 'Armor',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 16,
				'name' => 'RawResource',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array(
				'id' => 17,
				'name' => 'CraftingComponent',
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
