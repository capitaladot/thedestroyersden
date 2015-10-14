<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\ItemType;
class ItemTypeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$item_types = [
			['title' =>'Tool', 'slug'=>str_slug('Tool'),'id'=>1],
			['title' =>'Consumable', 'slug'=>str_slug('Consumable'),'id'=>2],
			['title' =>'Crafting Component', 'slug'=>str_slug('Crafting Component'),'id'=>3],
			['title' =>'Raw Resource', 'slug'=>str_slug('Raw Resource'),'id'=>4],
			['title' =>'Weapon', 'slug'=>str_slug('Weapon'),'id'=>5],
			['title' =>'Armor', 'slug'=>str_slug('Armor'),'id'=>6],
			['title' =>'Edifice', 'slug'=>str_slug('Edifice'),'id'=>7],
			['title' =>'Clothing', 'slug'=>str_slug('Clothing'),'id'=>8],
			['title' =>'Container', 'slug'=>str_slug('Container'),'id'=>9],
			['title' =>'Rune', 'slug'=>str_slug('Rune'),'id'=>10],
			['title' =>'Shield', 'slug'=>str_slug('Shield'),'id'=>11]
		];
		foreach($item_types as $item_type)
		{
			$this->command->info ( 'Creating item type:'.$item_type['title']. "... success: ".ItemType::create($item_type));
		}
		$this->command->info ( 'Created item types.');
	}

}
