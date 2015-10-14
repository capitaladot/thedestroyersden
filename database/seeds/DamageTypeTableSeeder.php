<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\DamageType;
class DamageTypeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$damage_types = [
			['title' =>'Hack', 'slug'=>str_slug('Hack'),'id'=>1],
			['title' =>'Crush', 'slug'=>str_slug('Crush'),'id'=>2],
			['title' =>'Poke', 'slug'=>str_slug('Poke'),'id'=>3],
			['title' =>'True', 'slug'=>str_slug('True'),'id'=>4],
			['title' =>'Air', 'slug'=>str_slug('Air'),'id'=>5],
			['title' =>'Fire', 'slug'=>str_slug('Fire'),'id'=>6],
			['title' =>'Earth', 'slug'=>str_slug('Earth'),'id'=>7],
			['title' =>'Ice', 'slug'=>str_slug('Ice'),'id'=>8],
			['title' =>'Spell', 'slug'=>str_slug('Spell'),'id'=>9],
			
		];
		foreach($damage_types as $damage_type)
		{
			$this->command->info ( 'Creating damage type:'.$damage_type['title']. "... success: ".DamageType::create($damage_type));
		}
		$this->command->info ( 'Created damage types.');
	}

}
