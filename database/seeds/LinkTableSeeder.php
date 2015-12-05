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
		$links = array(
		array( // row #0
			'id' => 1,
			'created_at' => '2015-05-08 13:03:42',
			'updated_at' => '2015-05-08 13:03:42',
			'link' => 'https://docs.google.com/document/d/1dhJJQw7grt4WcpIB7M-geoj5J6h4thJUE_0FM-jqGMk/pub',
			'slug' => 'rulebook',
			'title' => 'Rulebook',
		),
		array( // row #1
			'id' => 2,
			'created_at' => '2015-05-08 13:03:42',
			'updated_at' => '2015-05-08 13:03:42',
			'link' => 'https://docs.google.com/document/d/1hhi1XkIbHBHQClUqKUNsVL8kB6r7apiLa5ZRCAtvSZ8/pub',
			'slug' => 'crafters-guide',
			'title' => 'Crafter\'s Guide',
		),
		array( // row #2
			'id' => 3,
			'created_at' => '2015-05-08 13:03:42',
			'updated_at' => '2015-05-08 13:03:42',
			'link' => 'https://www.facebook.com/DestroyersDen/',
			'slug' => 'facebook',
			'title' => 'Facebook',
		),
		array( // row #3
			'id' => 4,
			'link' => 'https://docs.google.com/document/d/1d1rS_OhdkENDZVjdG-Wo4LUCCqlgZvy3eZOzpIDo7ls/pub',
			'slug' => 'character-sheet',
			'title' => 'Character Sheet',
		),
		array( // row #4
			'id' => 5,
			'link' => '/contact',
			'slug' => 'contact',
			'title' => 'Contact Us',
		),
		array( // row #5
			'id' => 6,
			'link' => 'https://docs.google.com/spreadsheets/d/1uoa18-QwjjEaBc2nVxj0USnO6DAUy0KJBh4ATFa8o-I/pubhtml',
			'slug' => 'perfected-products',
			'title' => 'Perfected Products',
		),
		array( // row #6
			'id' => 7,
			'link' => 'https://docs.google.com/spreadsheets/d/1B5THadRF-28p7M-wrrSm2-iATuEt7JVfXo6MDS1DOiU/pubhtml',
			'slug' => 'crafted-components',
			'title' => 'Crafted Components',
		),
		array( // row #7
			'id' => 8,
			'link' => 'https://docs.google.com/spreadsheets/d/1rSwB2Ya9upmddgwxxpieHxPm5DOnFD_t6V5-80pXsus/pubhtml',
			'slug' => 'raw-resources',
			'title' => 'Raw Resources',
		),
		array( // row #8
			'id' => 9,
			'link' => 'https://www.google.com/calendar/embed?src=qs05uvl9b2s4jiapvvealgfg94%40group.calendar.google.com&ctz=America%2FNew_York',
			'slug' => 'calendar',
			'title' => 'Calendar',
		),
		);
		foreach($links as $link){
			Link::create($link);
		}
		$this->command->info ( 'Link table seeded!' );
	}
}
