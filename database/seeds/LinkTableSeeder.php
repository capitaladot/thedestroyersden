<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Link;
class LinkTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Link::create ( [ 
				'title' => "Rulebook",
				'slug' => str_slug ( "Rulebook" ),
				'link' => "https://docs.google.com/document/d/1bIBRcrdKSh6j-yc1aTXAaneE-zh0evW8i0M1K_oUnBY/pub",
				'id' => 1 
		] );
		Link::create ( [ 
				'title' => "Crafter's Guide",
				'slug' => str_slug ( "Crafter's Guide" ),
				'link' => "https://docs.google.com/document/d/1QMInQjjVtDm4Kx0unh8KTtGK_YQaW2nZPl-kWZNBi_Q/pub",
				'id' => 2 
		] );
		Link::create ( [ 
				'title' => "Facebook",
				'slug' => str_slug ( "Facebook" ),
				'link' => "https://www.facebook.com/groups/TheDestroyersDenLARP",
				'id' => 3 
		] );
		Link::create ( [ 
				'title' => "Character Sheet",
				'slug' => str_slug ( "Character Sheet" ),
				'link' => "#https://docs.google.com/document/d/1LvrRuPaHhBRsF7qIMNNDekeHaLjha05vx8IXjXXz3wA/pub",
				'id' => 4 
		] );
		Link::create ( [ 
				'title' => "Contact Us",
				'slug' => str_slug ( "Contact" ),
				'link' => "/contact",
				'id' => 4 
		] );
		$this->command->info ( 'Link table seeded!' );
	}
}
