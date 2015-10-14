<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use MartinBean\MenuBuilder\MenuItem;

class MenuItemTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$menu_items = array(
			array( // row #0
				'id' => 1,
				'menu_id' => 1,
				'navigatable_id' => 1,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #1
				'id' => 3,
				'menu_id' => 1,

				'navigatable_id' => 3,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #2
				'id' => 9,
				'menu_id' => 1,
				'navigatable_id' => 4,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #3
				'id' => 10,
				'menu_id' => 1,
				'navigatable_id' => 5,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #4
				'id' => 4,
				'menu_id' => 2,
				'navigatable_id' => 1,
				'navigatable_type' => 'App\\User',
				'sort_order' => 0,
				'created_at' => '2015-05-08 15:15:39',
				'updated_at' => '2015-05-08 15:15:39',
			),
			array( // row #5
				'id' => 5,
				'menu_id' => 2,
				'navigatable_id' => 2,
				'navigatable_type' => 'App\\User',
				'sort_order' => 0,
				'created_at' => '2015-05-08 15:15:39',
				'updated_at' => '2015-05-08 15:15:39',
			),
			array( // row #6
				'id' => 7,
				'menu_id' => 2,
				'navigatable_id' => 3,
				'navigatable_type' => 'App\\User',
				'sort_order' => 0,
				'created_at' => '2015-05-12 13:15:52',
				'updated_at' => '2015-05-12 13:15:52',
			),
			array( // row #7
				'id' => 85,
				'menu_id' => 2,
				'navigatable_id' => 24,
				'navigatable_type' => 'App\\User',
				'sort_order' => 0,
				'created_at' => '2015-09-09 10:29:44',
				'updated_at' => '2015-09-09 10:29:44',
			),
			array( // row #8
				'id' => 86,
				'menu_id' => 2,
				'navigatable_id' => 25,
				'navigatable_type' => 'App\\User',
				'sort_order' => 0,
				'created_at' => '2015-09-09 10:30:31',
				'updated_at' => '2015-09-09 10:30:31',
			),
			array( // row #9
				'id' => 6,
				'menu_id' => 3,
				'navigatable_id' => 1,
				'navigatable_type' => 'App\\Event',
				'sort_order' => 0,
				'created_at' => '2015-05-12 11:52:26',
				'updated_at' => '2015-05-12 11:52:26',
			),
			array( // row #10
				'id' => 8,
				'menu_id' => 3,
				'navigatable_id' => 2,
				'navigatable_type' => 'App\\Event',
				'sort_order' => 0,
				'created_at' => '2015-05-20 08:22:36',
				'updated_at' => '2015-05-20 08:22:36',
			),
			array( // row #11
				'id' => 126,
				'menu_id' => 3,
				'navigatable_id' => 33,
				'navigatable_type' => 'App\\Event',
				'sort_order' => 0,
				'created_at' => '2015-09-09 13:08:02',
				'updated_at' => '2015-09-09 13:08:02',
			),
			array( // row #12
				'id' => 21,
				'menu_id' => 4,
				'navigatable_id' => 1,
				'navigatable_type' => 'App\\Arc',
				'sort_order' => 0,
				'created_at' => '2015-09-07 16:24:20',
				'updated_at' => '2015-09-07 16:24:20',
			),
			array( // row #13
				'id' => 19,
				'menu_id' => 4,
				'navigatable_id' => 2,
				'navigatable_type' => 'App\\Arc',
				'sort_order' => 0,
				'created_at' => '2015-09-07 14:30:30',
				'updated_at' => '2015-09-07 16:18:59',
			),
			array( // row #14
				'id' => 20,
				'menu_id' => 6,
				'navigatable_id' => 1,
				'navigatable_type' => 'App\\Economy',
				'sort_order' => 0,
				'created_at' => '2015-09-07 15:49:00',
				'updated_at' => '2015-09-07 15:49:00',
			),
			array( // row #15
				'id' => 2,
				'menu_id' => 9,
				'navigatable_id' => 2,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #16
				'id' => 23,
				'menu_id' => 9,
				'navigatable_id' => 6,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #17
				'id' => 26,
				'menu_id' => 9,
				'navigatable_id' => 7,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #18
				'id' => 27,
				'menu_id' => 9,
				'navigatable_id' => 8,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		);
		foreach($menu_items as $menu_item){
			$this->command->info ( 'Creating menu item:'.$menu_item['id']. "... success:".!empty(MenuItem::create($menu_item)));
		}
		$this->command->info ( 'Menu Item table seeded!' );
	}
}