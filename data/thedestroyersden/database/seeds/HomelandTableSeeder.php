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
		Homeland::create([
			['title' =>'Blight', 'slug'=>strolower('Blight'),'id'=>1],
			['title' =>'Cogland', 'slug'=>strolower('Cogland'),'id'=>2],
			['title' =>'Dacious', 'slug'=>strolower('Dacious'),'id'=>3],
			['title' =>'Englehelm', 'slug'=>strolower('Englehelm'),'id'=>4],
			['title' =>'Korkfinn', 'slug'=>strolower('Korkfinn'),'id'=>5],
			['title' =>'Lanoda', 'slug'=>strolower('Lanoda'),'id'=>6],
			['title' =>'Mor’magus', 'slug'=>strolower('Mor’magus'),'id'=>7],
			['title' =>'Nightshade', 'slug'=>strolower('Nightshade'),'id'=>8],
			['title' =>'Nimbuss', 'slug'=>strolower('Nimbuss'),'id'=>8],
			['title' =>'Sa’kyree', 'slug'=>strolower('Sakyree'),'id'=>9],
			['title' =>'San’jay', 'slug'=>strolower('Sanjay'),'id'=>10],
			['title' =>'Totem Valley', 'slug'=>strolower('TotemValley'),'id'=>11],
			['title' =>'Uhl’who', 'slug'=>strolower('Uhlwho'),'id'=>12],
			['title' =>'Explorer', 'slug'=>strolower('Explorer'),'id'=>13]
		]);
	}

}
