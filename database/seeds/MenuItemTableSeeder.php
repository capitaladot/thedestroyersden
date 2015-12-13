<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use MartinBean\MenuBuilder\MenuItem;
use App\MainMenu;

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
				'menu_id' => MainMenu::where('name','=','Link')->firstOrFail()->id,
				'navigatable_id' => 1,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #1
				'menu_id' => MainMenu::where('name','=','Link')->firstOrFail()->id,
				'navigatable_id' => 3,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #2
				'menu_id' => MainMenu::where('name','=','Link')->firstOrFail()->id,
				'navigatable_id' => 4,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #3
				'menu_id' => MainMenu::where('name','=','Link')->firstOrFail()->id,
				'navigatable_id' => 5,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #15
				'menu_id' => MainMenu::where('name','=','Crafting')->firstOrFail()->id,
				'navigatable_id' => 2,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '2015-05-08 13:03:42',
				'updated_at' => '2015-05-08 13:03:42',
			),
			array( // row #16
				'menu_id' => MainMenu::where('name','=','Crafting')->firstOrFail()->id,
				'navigatable_id' => 6,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #17
				'menu_id' => MainMenu::where('name','=','Crafting')->firstOrFail()->id,
				'navigatable_id' => 7,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			array( // row #18
				'menu_id' => MainMenu::where('name','=','Crafting')->firstOrFail()->id,
				'navigatable_id' => 8,
				'navigatable_type' => 'App\\Link',
				'sort_order' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		);
		foreach($menu_items as $index=> $menu_item){
			$this->command->info ( 'Creating menu item:'.$index. "... success:".!empty(MenuItem::create($menu_item)));
		}
		$this->command->info ( 'Menu Item table seeded!' );
	}
}