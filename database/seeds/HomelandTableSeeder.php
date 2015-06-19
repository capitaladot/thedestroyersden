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
			['title' =>'Blight', 'slug'=>str_slug('Blight'),'id'=>1],
			['title' =>'Cogland', 'slug'=>str_slug('Cogland'),'id'=>2],
			['title' =>'Dacious', 'slug'=>str_slug('Dacious'),'id'=>3],
			['title' =>'Englehelm', 'slug'=>str_slug('Englehelm'),'id'=>4],
			['title' =>'Korkfinn', 'slug'=>str_slug('Korkfinn'),'id'=>5],
			['title' =>'Lanoda', 'slug'=>str_slug('Lanoda'),'id'=>6],
			['title' =>'Mor’magus', 'slug'=>str_slug('Mor’magus'),'id'=>7],
			['title' =>'Nightshade', 'slug'=>str_slug('Nightshade'),'id'=>8],
			['title' =>'Nimbuss', 'slug'=>str_slug('Nimbuss'),'id'=>8],
			['title' =>'Sa’kyree', 'slug'=>str_slug('Sakyree'),'id'=>9],
			['title' =>'San’jay', 'slug'=>str_slug('Sanjay'),'id'=>10],
			['title' =>'Totem Valley', 'slug'=>str_slug('TotemValley'),'id'=>11],
			['title' =>'Uhl’who', 'slug'=>str_slug('Uhlwho'),'id'=>12],
			['title' =>'Explorer', 'slug'=>str_slug('Explorer'),'id'=>13]
		]);
	}

}
