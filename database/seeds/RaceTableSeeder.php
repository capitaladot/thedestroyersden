<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RaceTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Race::create([
			['title' =>'Adversarian', 'slug'=>strolower('Adversarian'),'id'=>1],
			['title' =>'Armaga', 'slug'=>strolower('Armaga'),'id'=>2],
			['title' =>'Dreddlin', 'slug'=>strolower('Dreddlin'),'id'=>3],
			['title' =>'Elisati', 'slug'=>strolower('Elisati'),'id'=>4],
			['title' =>'Felmane', 'slug'=>strolower('Felmane'),'id'=>5],
			['title' =>'Foxeen', 'slug'=>strolower('Foxeen'),'id'=>6],
			['title' =>'Gargoyle', 'slug'=>strolower('Gargoyle'),'id'=>7],
			['title' =>'Krowtower', 'slug'=>strolower('Krowtower'),'id'=>8],
			['title' =>'Saurin', 'slug'=>strolower('Saurin'),'id'=>9],
			['title' =>'Merfolk', 'slug'=>strolower('Merfolk'),'id'=>10],
			['title' =>'Roehart', 'slug'=>strolower('Roehart'),'id'=>11],
			['title' =>'Succubus', 'slug'=>strolower('Succubus'),'id'=>12],
			['title' =>'Vanquill', 'slug'=>strolower('Vanquill'),'id'=>13],
			['title' =>'Warkai', 'slug'=>strolower('Warkai'),'id'=>14]
		]);
	}

}
