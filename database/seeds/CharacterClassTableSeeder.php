<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CharacterClassTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		CharacterClass::create([
			['title' =>'Artisan', 'slug'=>strolower('Artisan'),'id'=>1],
			['title' =>'Arcane Warrior', 'slug'=>strolower('Arcane Warrior'),'id'=>2],
			['title' =>'Bard', 'slug'=>strolower('Bard'),'id'=>2],
			['title' =>'Battle Monk', 'slug'=>strolower('Battle Monk'),'id'=>4],
			['title' =>'Cleric', 'slug'=>strolower('Cleric'),'id'=>5],
			['title' =>'Druid', 'slug'=>strolower('Druid'),'id'=>6],
			['title' =>'Physician', 'slug'=>strolower('Physician'),'id'=>7],
			['title' =>'Ranger', 'slug'=>strolower('Ranger'),'id'=>8],
			['title' =>'Rogue', 'slug'=>strolower('Rogue'),'id'=>9],
			['title' =>'Sorcerer', 'slug'=>strolower('Sorcerer'),'id'=>10],
			['title' =>'Tactician', 'slug'=>strolower('Tactician'),'id'=>11],
			['title' =>'Warrior', 'slug'=>strolower('Warrior'),'id'=>12]
		]);
	}

}
