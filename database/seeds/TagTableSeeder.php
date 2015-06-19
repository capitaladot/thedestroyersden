<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Tag;
class TagTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		Tag::create ( [ 
				'id' => 1,
				'title' => 'Common',
				'slug' => str_slug ( 'Common' ) 
		] );
		Tag::create ( [ 
				'id' => 2,
				'title' => 'Rare',
				'slug' => str_slug ( 'Rarities' ) 
		] );
		Tag::create ( [ 
				'id' => 3,
				'title' => 'Mineral',
				'slug' => str_slug ( 'Mineral' ) 
		] );
		Tag::create ( [ 
				'id' => 4,
				'title' => 'Metal Ore',
				'slug' => str_slug ( 'Metal Ore' ) 
		] );
		Tag::create ( [ 
				'id' => 5,
				'title' => 'Components and Chemicals',
				'slug' => str_slug ( 'Components and Chemicals' ) 
		] );
		Tag::create ( [ 
				'id' => 6,
				'title' => 'Stone',
				'slug' => str_slug ( 'Stone' ) 
		] );
		Tag::create ( [ 
				'id' => 7,
				'title' => 'Gem Ore',
				'slug' => str_slug ( 'Gem Ore' ) 
		] );
		Tag::create ( [ 
				'id' => 8,
				'title' => 'Metal',
				'slug' => str_slug ( 'Metal' ) 
		] );
		Tag::create ( [ 
				'id' => 9,
				'title' => 'Fruit',
				'slug' => str_slug ( 'Fruit' ) 
		] );
		Tag::create ( [ 
				'id' => 10,
				'title' => 'Of the Bush',
				'slug' => str_slug ( 'Of the Bush' ) 
		] );
		Tag::create ( [ 
				'id' => 11,
				'title' => 'Berries',
				'slug' => str_slug ( 'Berries' ) 
		] );
		Tag::create ( [ 
				'id' => 12,
				'title' => 'Plant',
				'slug' => str_slug ( 'Plant' ) 
		] );
		Tag::create ( [ 
				'id' => 13,
				'title' => 'Leaves (consumable)' 
		] );
		Tag::create ( [ 
				'id' => 14,
				'title' => 'Peppers',
				'slug' => str_slug ( 'Peppers' ) 
		] );
		Tag::create ( [ 
				'id' => 15,
				'title' => 'Of The Tree',
				'slug' => str_slug ( 'Of The Tree' ) 
		] );
		Tag::create ( [ 
				'id' => 16,
				'title' => 'Of the Vine',
				'slug' => str_slug ( 'Of the Vine' ) 
		] );
		Tag::create ( [ 
				'id' => 17,
				'title' => 'Of the Meadow',
				'slug' => str_slug ( 'Of the Meadow' ) 
		] );
		Tag::create ( [ 
				'id' => 18,
				'title' => 'Of The Earth',
				'slug' => str_slug ( 'Of The Earth' ) 
		] );
		Tag::create ( [ 
				'id' => 19,
				'title' => 'Grain and Grass',
				'slug' => str_slug ( 'Grain and Grass' ) 
		] );
		Tag::create ( [ 
				'id' => 20,
				'title' => 'Herbs',
				'slug' => str_slug ( 'Herbs' ) 
		] );
		Tag::create ( [ 
				'id' => 21,
				'title' => 'Of the Bark',
				'slug' => str_slug ( 'Of the Bark' ) 
		] );
		Tag::create ( [ 
				'id' => 22,
				'title' => 'Animal',
				'slug' => str_slug ( 'Animal' ) 
		] );
		Tag::create ( [ 
				'id' => 23,
				'title' => 'Poultry',
				'slug' => str_slug ( 'Poultry' ) 
		] );
		Tag::create ( [ 
				'id' => 24,
				'title' => 'Fish',
				'slug' => str_slug ( 'Fish' ) 
		] );
		Tag::create ( [ 
				'id' => 25,
				'title' => 'Sharks, Rays, and Skates',
				'slug' => strtolower ( 'Sharks, Rays, and Skates' ) 
		] );
		Tag::create ( [ 
				'id' => 26,
				'title' => 'Insects and Arachnids',
				'slug' => str_slug ( 'Insects and Arachnids' ) 
		] );
		Tag::create ( [ 
				'id' => 27,
				'title' => 'Beasts of the Land',
				'slug' => str_slug ( 'Beasts of the Land' ) 
		] );
		Tag::create ( [ 
				'id' => 28,
				'title' => 'Cattle, Pigs and Oxen',
				'slug' => strtolower ( 'Cattle, Pigs and Oxen' ) 
		] );
		Tag::create ( [ 
				'id' => 29,
				'title' => 'Reptiles',
				'slug' => str_slug ( 'Reptiles' ) 
		] );
	}
}
