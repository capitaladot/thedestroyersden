<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CharacterClass;
class CharacterClassTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		CharacterClass::create ( [ 
				'title' => 'Artisan',
				'slug' => str_slug ( 'Artisan' ),
				'id' => 1 
		] );
		CharacterClass::create ( [ 
				'title' => 'Arcane Warrior',
				'slug' => str_slug ( 'Arcane Warrior' ),
				'id' => 2 
		] );
		CharacterClass::create ( [ 
				'title' => 'Bard',
				'slug' => str_slug ( 'Bard' ),
				'id' => 3 
		] );
		CharacterClass::create ( [ 
				'title' => 'Battle Monk',
				'slug' => str_slug ( 'Battle Monk' ),
				'id' => 4 
		] );
		CharacterClass::create ( [ 
				'title' => 'Cleric',
				'slug' => str_slug ( 'Cleric' ),
				'id' => 5 
		] );
		CharacterClass::create ( [ 
				'title' => 'Druid',
				'slug' => str_slug ( 'Druid' ),
				'id' => 6 
		] );
		CharacterClass::create ( [ 
				'title' => 'Physician',
				'slug' => str_slug ( 'Physician' ),
				'id' => 7 
		] );
		CharacterClass::create ( [ 
				'title' => 'Ranger',
				'slug' => str_slug ( 'Ranger' ),
				'id' => 8 
		] );
		CharacterClass::create ( [ 
				'title' => 'Rogue',
				'slug' => str_slug ( 'Rogue' ),
				'id' => 9 
		] );
		CharacterClass::create ( [ 
				'title' => 'Sorcerer',
				'slug' => str_slug ( 'Sorcerer' ),
				'id' => 10 
		] );
		CharacterClass::create ( [ 
				'title' => 'Tactician',
				'slug' => str_slug ( 'Tactician' ),
				'id' => 11 
		] );
		CharacterClass::create ( [ 
				'title' => 'Warrior',
				'slug' => str_slug ( 'Warrior' ),
				'id' => 12 
		] );
	}
}
