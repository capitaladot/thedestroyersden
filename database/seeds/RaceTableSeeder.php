<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class RaceTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		Race::create ( [ 
				'title' => 'Adversarian',
				'slug' => str_slug ( 'Adversarian' ),
				'id' => 1 
		] );
		Race::create ( [ 
				'title' => 'Armaga',
				'slug' => str_slug ( 'Armaga' ),
				'id' => 2 
		] );
		Race::create ( [ 
				'title' => 'Dreddlin',
				'slug' => str_slug ( 'Dreddlin' ),
				'id' => 3 
		] );
		Race::create ( [ 
				'title' => 'Elisati',
				'slug' => str_slug ( 'Elisati' ),
				'id' => 4 
		] );
		Race::create ( [ 
				'title' => 'Felmane',
				'slug' => str_slug ( 'Felmane' ),
				'id' => 5 
		] );
		Race::create ( [ 
				'title' => 'Foxeen',
				'slug' => str_slug ( 'Foxeen' ),
				'id' => 6 
		] );
		Race::create ( [ 
				'title' => 'Gargoyle',
				'slug' => str_slug ( 'Gargoyle' ),
				'id' => 7 
		] );
		Race::create ( [ 
				'title' => 'Krowtower',
				'slug' => str_slug ( 'Krowtower' ),
				'id' => 8 
		] );
		Race::create ( [ 
				'title' => 'Saurin',
				'slug' => str_slug ( 'Saurin' ),
				'id' => 9 
		] );
		Race::create ( [ 
				'title' => 'Merfolk',
				'slug' => str_slug ( 'Merfolk' ),
				'id' => 10 
		] );
		Race::create ( [ 
				'title' => 'Roehart',
				'slug' => str_slug ( 'Roehart' ),
				'id' => 11 
		] );
		Race::create ( [ 
				'title' => 'Succubus',
				'slug' => str_slug ( 'Succubus' ),
				'id' => 12 
		] );
		Race::create ( [ 
				'title' => 'Vanquill',
				'slug' => str_slug ( 'Vanquill' ),
				'id' => 13 
		] );
		Race::create ( [ 
				'title' => 'Warkai',
				'slug' => str_slug ( 'Warkai' ),
				'id' => 14 
		] );
	}
}
