<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TagTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Tag::create([
			['id'=>1,'title'=>'Common','slug'=>snake_case(strtolower('Common'))],
			['id'=>2,'title'=>'Rare','slug'=>snake_case(strtolower('Rarities'))],
			['id'=>3,'title'=>'Mineral','slug'=>snake_case(strtolower('Mineral'))],
			['id'=>4,'title'=>'Metal Ore','slug'=>snake_case(strtolower('Metal Ore'))],
			['id'=>5,'title'=>'Components and Chemicals','slug'=>snake_case(strtolower('Components and Chemicals'))],
			['id'=>6,'title'=>'Stone','slug'=>snake_case(strtolower('Stone'))],
			['id'=>7,'title'=>'Gem Ore','slug'=>snake_case(strtolower('Gem Ore'))],
			['id'=>8,'title'=>'Metal','slug'=>snake_case(strtolower('Metal'))],
			['id'=>9,'title'=>'Fruit','slug'=>snake_case(strtolower('Fruit'))],
			['id'=>10,'title'=>'Of the Bush','slug'=>snake_case(strtolower('Of the Bush'))],
			['id'=>11,'title'=>'Berries','slug'=>snake_case(strtolower('Berries'))],
			['id'=>12,'title'=>'Plant','slug'=>snake_case(strtolower('Plant'))],
			['id'=>13,'title'=>'Leaves (consumable)'],
			['id'=>14,'title'=>'Peppers','slug'=>snake_case(strtolower('Peppers'))],
			['id'=>15,'title'=>'Of The Tree','slug'=>snake_case(strtolower('Of The Tree'))],
			['id'=>16,'title'=>'Of the Vine','slug'=>snake_case(strtolower('Of the Vine'))],
			['id'=>17,'title'=>'Of the Meadow','slug'=>snake_case(strtolower('Of the Meadow'))],
			['id'=>18,'title'=>'Of The Earth','slug'=>snake_case(strtolower('Of The Earth'))],
			['id'=>19,'title'=>'Grain and Grass','slug'=>snake_case(strtolower('Grain and Grass'))],
			['id'=>20,'title'=>'Herbs','slug'=>snake_case(strtolower('Herbs'))],
			['id'=>21,'title'=>'Of the Bark','slug'=>snake_case(strtolower('Of the Bark'))],
			['id'=>22,'title'=>'Animal','slug'=>snake_case(strtolower('Animal'))],
			['id'=>23,'title'=>'Poultry','slug'=>snake_case(strtolower('Poultry'))],
			['id'=>24,'title'=>'Fish','slug'=>snake_case(strtolower('Fish'))],
			['id'=>25,'title'=>'Sharks, Rays, and Skates','slug'=>strtolower('Sharks, Rays, and Skates')],
			['id'=>26,'title'=>'Insects and Arachnids','slug'=>snake_case(strtolower('Insects and Arachnids'))],
			['id'=>27,'title'=>'Beasts of the Land','slug'=>snake_case(strtolower('Beasts of the Land'))],
			['id'=>28,'title'=>'Cattle, Pigs and Oxen','slug'=>strtolower('Cattle, Pigs and Oxen')],
			['id'=>29,'title'=>'Reptiles','slug'=>snake_case(strtolower('Reptiles'))]
		]);
	}
}
