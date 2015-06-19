<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Magic;
class MagicTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * Casting Spells… Page 82
	 * Purchasing Spells… Page 82
	 * Air… Page 83, 84
	 * Astral… Page 85, 86
	 * Blood Magic… Page 87, 88
	 * Earth… Page 89, 90
	 * Energy… Page 91, 92
	 * Fire… Page 93, 94
	 * Force… Page 95, 96
	 * Holy… Page 97, 98
	 * Lightning… Page 99, 100
	 * Mental… Page 101, 102
	 * Necromancy… Page 103, 104
	 * Unholy… Page 105, 106
	 * Water… Page 107, 108
	 *
	 * @return void
	 */
	public function run() {
		Magic::create ( [ 
				'title' => "Air",
				'slug' => str_slug ( "Air" ),
				'id' => 1 
		] );
		Magic::create ( [ 
				'title' => "Astral",
				'slug' => str_slug ( "Astral" ),
				'id' => 2 
		] );
		Magic::create ( [ 
				'title' => "Blood Magic",
				'slug' => str_slug ( "Blood Magic" ),
				'id' => 3 
		] );
		Magic::create ( [ 
				'title' => "Earth",
				'slug' => str_slug ( "Earth" ),
				'id' => 4 
		] );
		Magic::create ( [ 
				'title' => "Energy",
				'slug' => str_slug ( "Energy" ),
				'id' => 5 
		] );
		Magic::create ( [ 
				'title' => "Fire",
				'slug' => str_slug ( "Fire" ),
				'id' => 6 
		] );
		Magic::create ( [ 
				'title' => "Force",
				'slug' => str_slug ( "Force" ),
				'id' => 7 
		] );
		Magic::create ( [ 
				'title' => "Holy",
				'slug' => str_slug ( "Holy" ),
				'id' => 8 
		] );
		Magic::create ( [ 
				'title' => "Lightning",
				'slug' => str_slug ( "Lightning" ),
				'id' => 9 
		] );
		Magic::create ( [ 
				'title' => "Mental",
				'slug' => str_slug ( "Mental" ),
				'id' => 10 
		] );
		Magic::create ( [ 
				'title' => "Necromancy",
				'slug' => str_slug ( "Necromancy" ),
				'id' => 11 
		] );
		Magic::create ( [ 
				'title' => "Unholy",
				'slug' => str_slug ( "Unholy" ),
				'id' => 12 
		] );
		Magic::create ( [ 
				'title' => "Water",
				'slug' => str_slug ( "Water" ),
				'id' => 13 
		] );
		$this->command->info ( 'Magic table seeded!' );
	}
}
