<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HomelandTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Tool::create([
			['title'=>'Tools and Dies','slug'=>snake_case(strtolower('Tools and Dies')),'used_by'=>'Toolmaker, Gunsmith'],
			['title'=>'Gun Barrel Brush','slug'=>snake_case(strtolower('Gun Barrel Brush')),'used_by'=>'Gunsmith'],
			['title'=>'Erector’s Set','slug'=>snake_case(strtolower('Erector’s Set')),'used_by'=>'Erector'],
			['title'=>'Glasser’s Gear','slug'=>snake_case(strtolower('Glasser’s Gear')),'used_by'=>'Earthworker'],
			['title'=>'Bullet Mold','slug'=>snake_case(strtolower('Bullet Mold')),'used_by'=>'Metallurge'],
			['title'=>'Crow’s Bar','slug'=>snake_case(strtolower('Crow’s Bar')),'used_by'=>'Salvager'],
			['title'=>'Gemcutter','slug'=>snake_case(strtolower('Gemcutter')),'used_by'=>'Gemsmith'],
			['title'=>'Tiny Tools','slug'=>snake_case(strtolower('Tiny Tools')),'used_by'=>'Mechanist, Gemsmith, Gunsmith, Salvager'],
			['title'=>'Stonecutter','slug'=>snake_case(strtolower('Stonecutter')),'used_by'=>'Earthworker'],
			['title'=>'Tinker’s Templates','slug'=>snake_case(strtolower('Tinker’s Templates')),'used_by'=>'Tinker'],
			['title'=>'Bark Scraper','slug'=>snake_case(strtolower('Bark Scraper')),'used_by'=>'Woodcutter'],
			['title'=>'Woodsman’s Axe','slug'=>snake_case(strtolower('Woodsman’s Axe')),'used_by'=>'Woodcutter'],
			['title'=>'Whittling Knife','slug'=>snake_case(strtolower('Whittling Knife')),'used_by'=>'Whittler'],
			['title'=>'Knitting Needles','slug'=>snake_case(strtolower('Knitting Needles')),'used_by'=>'Weaver'],
			['title'=>'Loom','slug'=>snake_case(strtolower('Loom')),'used_by'=>'Weaver'],
			['title'=>'Sewing Awl','slug'=>snake_case(strtolower('Sewing Awl')),'used_by'=>'Clothier, Leathermaker'],
			['title'=>'Hat Mold','slug'=>snake_case(strtolower('Hat Mold')),'used_by'=>'Clothier'],
			['title'=>'Sawyer’s Saw','slug'=>snake_case(strtolower('Sawyer’s Saw')),'used_by'=>'Woodcutter'],
			['title'=>'Spinning Wheel','slug'=>snake_case(strtolower('Spinning Wheel')),'used_by'=>'Clothier'],
			['title'=>'Still','slug'=>snake_case(strtolower('Still')),'used_by'=>'Distiller, Potionmaster'],
			['title'=>'Filet Knife','slug'=>snake_case(strtolower('Filet Knife')),'used_by'=>'Butcher'],
			['title'=>'Butcher’s Cleaver ','slug'=>snake_case(strtolower('Butcher’s Cleaver ')),'used_by'=>'Butcher'],
			['title'=>'Glasser’s Tools','slug'=>snake_case(strtolower('Glasser’s Tools')),'used_by'=>'Earthworker'],
			['title'=>'Potter’s Wheel','slug'=>snake_case(strtolower('Potter’s Wheel')),'used_by'=>'Earthworker'],
			['title'=>'Maker’s Mallet','slug'=>snake_case(strtolower('Maker’s Mallet')),'used_by'=>'Tinker, Gunsmith, Armsmaker, Preservationist'],
			['title'=>'Mortar and Pestle','slug'=>snake_case(strtolower('Mortar and Pestle')),'used_by'=>'Potionmaster, Chemist, Cook'],
			['title'=>'Chemistry Kit','slug'=>snake_case(strtolower('Chemistry Kit')),'used_by'=>'Chemist, Cook'],
			['title'=>'Fishing Net','slug'=>snake_case(strtolower('Fishing Net')),'used_by'=>'Farmer'],
			['title'=>'Shovel','slug'=>snake_case(strtolower('Shovel')),'used_by'=>'Farmer'],
			['title'=>'Scraping Knife','slug'=>snake_case(strtolower('Scraping Knife')),'used_by'=>'Butcher'],
			['title'=>'Oven','slug'=>snake_case(strtolower('Oven')),'used_by'=>'Cook'],
			['title'=>'Kettle','slug'=>snake_case(strtolower('Kettle')),'used_by'=>'Cook, Brewmaster'],
			['title'=>'Tumbler','slug'=>snake_case(strtolower('Tumbler')),'used_by'=>'Gemsmith'],
			['title'=>'Furnace','slug'=>snake_case(strtolower('Furnace')),'used_by'=>'Bladesmith, Metallurge'],
			['title'=>'Prospector’s Pick','slug'=>snake_case(strtolower('Prospector’s Pick')),'used_by'=>'Miner'],
			['title'=>'Cutting Ruby','slug'=>snake_case(strtolower('Cutting Ruby')),'used_by'=>'Metallurge'],
			['title'=>'Cutting Diamond','slug'=>snake_case(strtolower('Cutting Diamond')),'used_by'=>'Gemsmith'],
			['title'=>'Basin','slug'=>snake_case(strtolower('Basin')),'used_by'=>'Brewmaster, Preservationist'],
			['title'=>'Superior Snips','slug'=>snake_case(strtolower('Superior Snips')),'used_by'=>'Metallurge, Armorer'],
			['title'=>'Ring Rig','slug'=>snake_case(strtolower('Ring Rig')),'used_by'=>'Armorer'],
			['title'=>'Armorer’s Anvil','slug'=>snake_case(strtolower('Armorer’s Anvil')),'used_by'=>'Armorer'],
			['title'=>'Spit','slug'=>snake_case(strtolower('Spit')),'used_by'=>'Cook'],
			['title'=>'Dowsing Rod','slug'=>snake_case(strtolower('Dowsing Rod')),'used_by'=>'Miner'],
			['title'=>'Sugar Spile','slug'=>snake_case(strtolower('Sugar Spile')),'used_by'=>'Woodcutter'],
			['title'=>'Melting Pot','slug'=>snake_case(strtolower('Melting Pot')),'used_by'=>'Metallurge, Chandler'],
		]);
	}

}
