<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Event;
class EventTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		
		Event::create ( [ 
				'title' => 'Playtest 1',
				'name' => 'Playtest 1',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
		Event::create ( [ 
				'title' => 'Season 1 Game 1',
				'name' => 'Season 1 Game 1',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
		Event::create ( [ 
				'title' => 'Season 1 Game 2',
				'name' => 'Season 1 Game 2',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
		Event::create ( [ 
				'title' => 'Season 1 Game 3',
				'name' => 'Season 1 Game 3',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
		Event::create ( [ 
				'title' => 'Season 1 Game 4',
				'name' => 'Season 1 Game 4',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
		Event::create ( [ 
				'title' => 'Season 1 Game 5',
				'name' => 'Season 1 Game 5',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
		Event::create ( [ 
				'title' => 'Season 1 Game 6',
				'name' => 'Season 1 Game 6',
				'start_time' => new DateTime (),
				'end_time' => new DateTime () 
		] );
	}
}
