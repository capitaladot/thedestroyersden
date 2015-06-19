<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\RawResource;
class RawResourceTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 * ']);RawResource::create(
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		RawResource::create ( 
				// Common
				// Rare
				// Mineral
				// Metal Ore
				[ 
						'id' => 1,
						'title' => 'Iron Ore',
						'slug' => str_slug ( strtolower ( 'Iron Ore' ) )/* Iron, Steel, Stainless */] );
		RawResource::create ( [ 
				'id' => 2,
				'title' => 'Lead Ore',
				'slug' => str_slug ( strtolower ( 'Lead Ore' ) )/* Bullets, balanced Melee Weapons */] );
		RawResource::create ( [ 
				'id' => 3,
				'title' => 'Zinc Ore',
				'slug' => str_slug ( strtolower ( 'Zinc Ore' ) )/* Gunmetal, Superior Whetstones */] );
		RawResource::create ( [ 
				'id' => 4,
				'title' => 'Chromite Ore',
				'slug' => str_slug ( strtolower ( 'Chromite Ore' ) )/* Chromium */] );
		RawResource::create ( [ 
				'id' => 5,
				'title' => 'Copper Ore',
				'slug' => str_slug ( strtolower ( 'Copper Ore' ) )/* Copper, Bronze */] );
		RawResource::create ( [ 
				'id' => 6,
				'title' => 'Tin Ore',
				'slug' => str_slug ( strtolower ( 'Tin Ore' ) )/*(Tinker’s goods)*/] );
		RawResource::create ( [ 
				'id' => 7,
				'title' => 'Manganese Ore',
				'slug' => str_slug ( strtolower ( 'Manganese Ore' ) )/* Manganese */] );
		RawResource::create ( [ 
				'id' => 8,
				'title' => 'Gold Dust',
				'slug' => str_slug ( strtolower ( 'Gold Dust' ) )/* Gold */] );
		RawResource::create ( [ 
				'id' => 9,
				'title' => 'Silver Shavings',
				'slug' => str_slug ( strtolower ( 'Silver Shavings' ) )/* Silver */] );
		RawResource::create ( 
				// Components and Chemicals
				[ 
						'id' => 10,
						'title' => 'Coal',
						'slug' => str_slug ( strtolower ( 'Coal' ) )/* smelting */] );
		RawResource::create ( [ 
				'id' => 11,
				'title' => 'Saltpeter',
				'slug' => str_slug ( strtolower ( 'Saltpeter' ) )/* Gunpowder */] );
		RawResource::create ( [ 
				'id' => 12,
				'title' => 'Clay',
				'slug' => str_slug ( strtolower ( 'Clay' ) )/* Ovens, Vessels, Superior Whetstones, Tiles */] );
		RawResource::create ( [ 
				'id' => 13,
				'title' => 'Water',
				'slug' => str_slug ( strtolower ( 'Water' ) )/* various Brews, Distillates, Potions, Soups, and Stews */] );
		RawResource::create ( 
				// Stone
				[ 
						'id' => 14,
						'title' => 'Whetstone',
						'slug' => str_slug ( strtolower ( 'Whetstone' ) )/* sharpened Melee Weapons */] );
		RawResource::create ( [ 
				'id' => 15,
				'title' => 'Living Limestone',
				'slug' => str_slug ( strtolower ( 'Living Limestone' ) )/* Potions */] );
		RawResource::create ( [ 
				'id' => 16,
				'title' => 'Massidium',
				'slug' => str_slug ( strtolower ( 'Massidium' ) )/* Potions */] );
		RawResource::create ( [ 
				'id' => 17,
				'title' => 'Sand',
				'slug' => str_slug ( strtolower ( 'Sand' ) )/* glass */] );
		RawResource::create ( 
				// Gem Ore
				[ 
						'id' => 18,
						'value' => 50,
						'title' => 'Garnet',
						'slug' => str_slug ( strtolower ( 'Garnet' ) ) 
				] );
		RawResource::create ( [ 
				'id' => 19,
				'value' => 60,
				'title' => 'Amethyst',
				'slug' => str_slug ( strtolower ( 'Amethyst' ) ) 
		] );
		RawResource::create ( [ 
				'id' => 20,
				'value' => 70,
				'title' => 'Ruby',
				'slug' => str_slug ( strtolower ( 'Ruby' ) ) 
		] );
		RawResource::create ( [ 
				'id' => 21,
				'value' => 80,
				'title' => 'Emerald',
				'slug' => str_slug ( strtolower ( 'Emerald' ) ) 
		] );
		RawResource::create ( [ 
				'id' => 22,
				'value' => 90,
				'title' => 'Sapphire',
				'slug' => str_slug ( strtolower ( 'Sapphire' ) ) 
		] );
		RawResource::create ( [ 
				'id' => 23,
				'value' => 100,
				'title' => 'Diamond',
				'slug' => str_slug ( strtolower ( 'Diamond' ) ) 
		] );
		RawResource::create ( 
				// Metal
				[ 
						'id' => 24,
						'title' => 'Chromium',
						'slug' => str_slug ( strtolower ( 'Chromium' ) )/* Stainless */] );
		RawResource::create ( [ 
				'id' => 25,
				'title' => 'Steel',
				'slug' => str_slug ( strtolower ( 'Steel' ) )/* Hack Blades and Pierce Points, Crush Heads, various Tools */] );
		RawResource::create ( [ 
				'id' => 26,
				'title' => 'Manganese (particularly sharp and break-resistant blades)' 
		] );
		RawResource::create ( [ 
				'id' => 27,
				'title' => 'Copper',
				'slug' => str_slug ( strtolower ( 'Copper' ) )/* gunmetal, vessels, flashing */] );
		RawResource::create ( [ 
				'id' => 28,
				'title' => 'Tin',
				'slug' => str_slug ( strtolower ( 'Tin' ) )/* Gunmetal, Vessels and Cooking Tools, flashing */] );
		RawResource::create ( [ 
				'id' => 29,
				'title' => 'Bronze',
				'slug' => str_slug ( strtolower ( 'Bronze' ) )/* gunsights, tools, crude Melee Weapons */] );
		RawResource::create ( [ 
				'id' => 30,
				'title' => 'Gold',
				'slug' => str_slug ( strtolower ( 'Gold' ) )/* bullets, weapon coatings */] );
		RawResource::create ( [ 
				'id' => 31,
				'title' => 'Silver',
				'slug' => str_slug ( strtolower ( 'Silver' ) )/* bullets, weapon coatings */] );
		RawResource::create ( 
				// Fruit
				// Of the Bush
				// Berries (consumable)
				// Common
				[ 
						'id' => 32,
						'title' => 'Berries',
						'slug' => str_slug ( strtolower ( 'Berries' ) ),
						'consumable' => true,
						'effect' => 'Heal 2' 
				] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 33,
						'value' => 20,
						'title' => 'Fresh Grinnin Berries',
						'slug' => str_slug ( strtolower ( 'Fresh Grinnin Berries' ) ),
						'consumable' => true,
						'effect' => 'Deals Pacify 10 minutes when ingested.' 
				] );
		RawResource::create ( [ 
				'id' => 34,
				'value' => 10,
				'title' => 'Dried Grinnin Berries',
				'slug' => str_slug ( strtolower ( 'Dried Grinnin Berries' ) ),
				'consumable' => true,
				'effect' => 'You become immune to Rage and Taunt for 10 minutes when ingested.' 
		] );
		RawResource::create ( [ 
				'id' => 35,
				'title' => 'Leaves',
				'slug' => str_slug ( strtolower ( 'Leaves' ) )/* consumable */] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 36,
						'value' => 5,
						'title' => 'Kaige Leaves',
						'slug' => str_slug ( strtolower ( 'Kaige Leaves' ) ),
						'consumable' => true,
						'effect' => 'You can remove the Stun effect from a target by touch.' 
				] );
		RawResource::create ( [ 
				'id' => 37,
				'value' => 50,
				'title' => 'St. Elsewhere’s Leaves',
				'consumable' => true,
				'effect' => 'Go Out of Game for 10 Seconds.' 
		] );
		RawResource::create ( 
				// Peppers
				// Common
				[ 
						'id' => 38,
						'title' => 'Bell Pepper',
						'slug' => str_slug ( strtolower ( 'Bell Pepper' ) )/* Cookery */] );
		RawResource::create ( [ 
				'id' => 39,
				'title' => 'Sweet Pepper',
				'slug' => str_slug ( strtolower ( 'Sweet Pepper' ) )/* Cookery */] );
		RawResource::create ( [ 
				'id' => 40,
				'title' => 'Hot Pepper',
				'slug' => str_slug ( strtolower ( 'Hot Pepper' ) )/* Cookery */] );
		RawResource::create ( 
				// Rarities
				[ 
						'id' => 41,
						'title' => 'Firepeppers',
						'slug' => str_slug ( strtolower ( 'Firepeppers' ) ),
						'consumable' => true,
						'effect' => 'Chewing for a 30 Count causes 3 Damage to the chewer, but grants a Melee Point Cast Fire Breath 5)' 
				] );
		RawResource::create ( 
				// Of The Tree
				// Common
				[ 
						'id' => 42,
						'title' => 'Apples',
						'slug' => str_slug ( strtolower ( 'Apples' ) ),
						'consumable' => true,
						'effect' => 'Heal 1' 
				] );
		RawResource::create ( [ 
				'id' => 43,
				'title' => 'Citrus',
				'slug' => str_slug ( strtolower ( 'Citrus' ) ),
				'consumable' => true,
				'effect' => 'Heal 1' 
		] );
		RawResource::create ( [ 
				'id' => 44,
				'title' => 'Pears',
				'slug' => str_slug ( strtolower ( 'Pears' ) ),
				'consumable' => true,
				'effect' => 'Heal 1' 
		] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 45,
						'value' => 5,
						'title' => 'Slaza Fruit',
						'slug' => str_slug ( strtolower ( 'Slaza Fruit' ) ),
						'consumable' => true,
						'effect' => 'Deals 5 Fire damage when ingested. You gain 1 Mana.' 
				] );
		RawResource::create ( 
				// Of the Vine
				// Common
				[ 
						'id' => 46,
						'title' => 'Grapes',
						'slug' => str_slug ( strtolower ( 'Grapes' ) ),
						'consumable' => true,
						'effect' => '1 whole bunch Heal 2)' 
				] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 47,
						'value' => 5,
						'title' => 'Julmungo Melon',
						'slug' => str_slug ( strtolower ( 'Julmungo Melon' ) ),
						'effect' => 'Enrage 1 Minute',
						'consumable' => true 
				] );
		RawResource::create ( [ 
				'id' => 48,
				'value' => 40,
				'title' => 'Bitterfruit (Heal 1 per Encounter for the remainder of the Day)' 
		] );
		RawResource::create ( [ 
				'id' => 49,
				'value' => 30,
				'title' => 'Sorcerous Speedberry (cast 1 Spell in half the time)' 
		] );
		RawResource::create ( 
				// ['id'=>,'title'=>' Of the Meadow']);RawResource::create(
				// ['id'=>,'title'=>' Rarities']);RawResource::create(
				[ 
						'id' => 50,
						'value' => 5,
						'title' => 'Elma Ivy',
						'slug' => str_slug ( strtolower ( 'Elma Ivy' ) ),
						'consumable' => true,
						'effect' => 'Heal 5 or remove 5 Poison damage.' 
				] );
		RawResource::create ( [ 
				'id' => 51,
				'value' => 10,
				'title' => 'Volcano Grass',
				'slug' => str_slug ( strtolower ( 'Volcano Grass' ) ),
				'consumable' => true,
				'effect' => 'Deals Rage 30 when ingested.' 
		] );
		RawResource::create ( [ 
				'id' => 52,
				'value' => 25,
				'title' => 'Selrit Stalk',
				'slug' => str_slug ( strtolower ( 'Selrit Stalk' ) ),
				'consumable' => true,
				'effect' => 'You can resist the Smash Limb effect once during the current day.' 
		] );
		RawResource::create ( [ 
				'id' => 53,
				'value' => 60,
				'title' => 'Callidadis Flower',
				'slug' => str_slug ( strtolower ( 'Callidadis Flower' ) ),
				'consumable' => true,
				'effect' => 'You gain 1 Dodge.' 
		] );
		RawResource::create ( [ 
				'id' => 54,
				'value' => 40,
				'title' => 'Chlora Pollen',
				'slug' => str_slug ( strtolower ( 'Chlora Pollen' ) ),
				'consumable' => true,
				'effect' => 'You gain a packet dealing Sleep 60.' 
		] );
		RawResource::create ( [ 
				'id' => 55,
				'value' => 30,
				'title' => 'Silver Spinach',
				'slug' => str_slug ( strtolower ( 'Silver Spinach' ) ),
				'consumable' => true,
				'effect' => 'Removes the Weakness effect when ingested.' 
		] );
		RawResource::create ( [ 
				'id' => 56,
				'value' => 20,
				'title' => 'Ink Lily',
				'slug' => str_slug ( strtolower ( 'Ink Lily' ) ),
				'consumable' => true,
				'effect' => 'a mana infused flower used for making ink for runes' 
		] );
		RawResource::create ( 
				// Of The Earth
				// Common
				[ 
						'id' => 57,
						'title' => 'Ginger',
						'slug' => str_slug ( strtolower ( 'Ginger' ) )/* Liqueurs */] );
		RawResource::create ( [ 
				'id' => 58,
				'title' => 'Onions',
				'slug' => str_slug ( strtolower ( 'Onions' ) )/* Cookery */] );
		RawResource::create ( [ 
				'id' => 59,
				'title' => 'Potatoes',
				'slug' => str_slug ( strtolower ( 'Potatoes' ) )/* Cookery */] );
		RawResource::create ( [ 
				'id' => 60,
				'title' => 'Turnips',
				'slug' => str_slug ( strtolower ( 'Turnips' ) )/* Cookery */] );
		RawResource::create ( [ 
				'id' => 61,
				'title' => 'Radishes',
				'slug' => str_slug ( strtolower ( 'Radishes' ) )/* Cookery */] );
		RawResource::create ( [ 
				'id' => 62,
				'title' => 'Carrots (Cookery',
				'consumable' => true,
				'effect' => 'Heal 1' 
		] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 63,
						'value' => 10,
						'title' => 'Fermented Brunis Root',
						'slug' => str_slug ( strtolower ( 'Fermented Brunis Root' ) ),
						'consumable' => true,
						'effect' => ' You gain a resist against the Weakness effect.)' 
				] );
		RawResource::create ( [ 
				'id' => 64,
				'value' => 10,
				'title' => 'Dozer Cap',
				'slug' => str_slug ( strtolower ( 'Dozer Cap' ) ),
				'consumable' => true,
				'effect' => ' You gain a packet dealing Stun 10)' 
		] );
		RawResource::create ( [ 
				'id' => 65,
				'value' => 50,
				'title' => 'Reddish',
				'slug' => str_slug ( strtolower ( 'Reddish' ) ),
				'consumable' => true,
				'effect' => ' Remove all Poison damage. You are immune to attacks using the Poison descriptor for 1 minute)' 
		] );
		RawResource::create ( [ 
				'id' => 66,
				'value' => 15,
				'title' => 'Viper Stripe Mushroom',
				'slug' => str_slug ( strtolower ( 'Viper Stripe Mushroom' ) ),
				'consumable' => true,
				'effect' => 'You gain a packet dealing 5 Acid damage)' 
		] );
		RawResource::create ( [ 
				'id' => 67,
				'value' => 15,
				'title' => 'Black Moss',
				'slug' => str_slug ( strtolower ( 'Black Moss' ) ),
				'consumable' => true,
				'effect' => ' Apply this to a single bow or melee weapon to convert its next attack to the Poison type)' 
		] );
		RawResource::create ( [ 
				'id' => 68,
				'value' => 25,
				'title' => 'Blood Onion',
				'slug' => str_slug ( strtolower ( 'Blood Onion' ) ),
				'consumable' => true,
				'effect' => ' Deals 2 Life Drain when ingested).' 
		] );
		RawResource::create ( [ 
				'id' => 69,
				'value' => 20,
				'title' => 'Sparkginger',
				'slug' => str_slug ( strtolower ( 'Sparkginger' ) ),
				'consumable' => true,
				'effect' => ' chewing for a 30 Count causes 3 Damage to the chewer, but grants a Melee Point Cast Lightning Breath 5)' 
		] );
		RawResource::create ( 
				// Grain and Grass
				[ 
						'id' => 70,
						'title' => 'Barley',
						'slug' => str_slug ( strtolower ( 'Barley' ) )/* Beer and Soup */] );
		RawResource::create ( [ 
				'id' => 71,
				'title' => 'Corn',
				'slug' => str_slug ( strtolower ( 'Corn' ) )/* Bread and Spirits */] );
		RawResource::create ( [ 
				'id' => 72,
				'title' => 'Flax',
				'slug' => str_slug ( strtolower ( 'Flax' ) )/* Linen Cloth, Twine */] );
		RawResource::create ( [ 
				'id' => 73,
				'title' => 'Hay',
				'slug' => str_slug ( strtolower ( 'Hay' ) )/* Animal feed */] );
		RawResource::create ( [ 
				'id' => 74,
				'title' => 'Maize',
				'slug' => str_slug ( strtolower ( 'Maize' ) )/* Bread and Spirits */] );
		RawResource::create ( [ 
				'id' => 75,
				'title' => 'Reeds',
				'slug' => str_slug ( strtolower ( 'Reeds' ) )/* Baskets */] );
		RawResource::create ( [ 
				'id' => 76,
				'title' => 'Straw',
				'slug' => str_slug ( strtolower ( 'Straw' ) )/* Roofing, Baskets, Animal feed */] );
		RawResource::create ( [ 
				'id' => 77,
				'title' => 'Wheat',
				'slug' => str_slug ( strtolower ( 'Wheat' ) )/* Bread, Beer, and Spirits */] );
		RawResource::create ( 
				// Herbs
				// Of the Vine
				[ 
						'id' => 78,
						'title' => 'Hops',
						'slug' => str_slug ( strtolower ( 'Hops' ) )/* Beer */] );
		RawResource::create ( 
				// Of the Bark
				[ 
						'id' => 79,
						'title' => 'Cinnamon',
						'slug' => str_slug ( strtolower ( 'Cinnamon' ) )/* Liqueur */] );
		RawResource::create ( [ 
				'id' => 80,
				'title' => 'Willow',
				'slug' => str_slug ( strtolower ( 'Willow' ) )/* Healing Potions */] );
		RawResource::create ( 
				// Of the Bush
				[ 
						'id' => 81,
						'title' => 'Feverfew',
						'slug' => str_slug ( strtolower ( 'Feverfew' ) )/* Potions */] );
		RawResource::create ( [ 
				'id' => 82,
				'title' => 'Tea',
				'slug' => str_slug ( strtolower ( 'Tea' ) )/* healing Draughts */] );
		RawResource::create ( [ 
				'id' => 83,
				'title' => 'Seed',
				'slug' => str_slug ( strtolower ( 'Seed' ) )/* used by a Farmer to grow a Tree, Bush, Vine, or a Row of Grain or Grass */] );
		RawResource::create ( 
				// Wood (Barrels, simple Tools, Edifices, weapon parts
				[ 
						'id' => 84,
						'title' => 'Ash',
						'slug' => str_slug ( strtolower ( 'Ash' ) )/* Hafts for Pole Weapons and other various Techniques */] );
		RawResource::create ( [ 
				'id' => 85,
				'title' => 'Cedar',
				'slug' => str_slug ( strtolower ( 'Cedar' ) )/* Arrow Shafts, Trunks to slow Entropy of Clothing */] );
		RawResource::create ( [ 
				'id' => 86,
				'title' => 'Oak',
				'slug' => str_slug ( strtolower ( 'Oak' ) )/* Charcoal, Bucklers and Targs, Gun Stocks */] );
		RawResource::create ( [ 
				'id' => 87,
				'title' => 'Yew',
				'slug' => str_slug ( strtolower ( 'Yew' ) )/* Staves for bows and other Wood Mechanisms */] );
		RawResource::create ( [ 
				'id' => 88,
				'title' => 'Charcoal',
				'slug' => str_slug ( strtolower ( 'Charcoal' ) )/* smelting, gunpowder */] );
		RawResource::create ( [ 
				'id' => 89,
				'title' => 'Cork',
				'slug' => str_slug ( strtolower ( 'Cork' ) )/* bottling */] );
		RawResource::create ( 
				// Animal
				// Poultry
				// Common
				[ 
						'id' => 90,
						'title' => 'Meat',
						'slug' => str_slug ( strtolower ( 'Meat' ) )/* various Cuts */] );
		RawResource::create ( [ 
				'id' => 91,
				'title' => 'Feathers',
				'slug' => str_slug ( strtolower ( 'Feathers' ) )/* Fletchings, Bedding */] );
		RawResource::create ( [ 
				'id' => 92,
				'title' => 'Tallow',
				'slug' => str_slug ( strtolower ( 'Tallow' ) )/* Tents, Candles */] );
		RawResource::create ( [ 
				'id' => 93,
				'title' => 'Eggs',
				'slug' => str_slug ( strtolower ( 'Eggs' ) )/* Cookery items, consumable */] );
		RawResource::create ( [ 
				'id' => 94,
				'title' => 'Leather',
				'slug' => str_slug ( strtolower ( 'Leather' ) )/* Weapon Grips, Sheaths, Targs, Quivers and Bucklers */] );
		RawResource::create ( 
				// Fish']);RawResource::create(
				// Common
				[ 
						'id' => 95,
						'title' => 'Filets',
						'slug' => str_slug ( strtolower ( 'Filets' ) ),
						'consumable' => true,
						'effect' => 'Heal 2' 
				] );
		RawResource::create ( [ 
				'id' => 96,
				'title' => 'Oil (Lamps,',
				'consumable' => true 
		] );
		RawResource::create ( 
				// Sharks, Rays, and Skates
				// Filets
				// Oil
				// Leather
				// Rare
				[ 
						'id' => 97,
						'value' => 10,
						'title' => 'Tacc Fish',
						'slug' => str_slug ( strtolower ( 'Tacc Fish' ) ),
						'consumable' => true,
						'effect' => 'Gain 1 Mana.' 
				] );
		RawResource::create ( [ 
				'id' => 98,
				'value' => 10,
				'title' => 'Hissing Blackfish',
				'slug' => str_slug ( strtolower ( 'Hissing Blackfish' ) ),
				'consumable' => true,
				'effect' => 'Remove 5 Poison damage.' 
		] );
		RawResource::create ( [ 
				'id' => 99,
				'value' => 10,
				'title' => 'Silma Fish',
				'slug' => str_slug ( strtolower ( 'Silma Fish' ) ),
				'consumable' => true,
				'effect' => 'Remove a single status effect.' 
		] );
		RawResource::create ( 
				// Insects and Arachnids
				// Common
				// Bees
				[ 
						'id' => 100,
						'title' => 'Honey',
						'slug' => str_slug ( strtolower ( 'Honey' ) ),
						'consumable' => true,
						'effect' => 'Heal 1)'/*Mead, Compresses*/] );
		RawResource::create ( [ 
				'id' => 101,
				'title' => 'Wax',
				'slug' => str_slug ( strtolower ( 'Wax' ) )/* sealing Bottles */] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 102,
						'value' => 10,
						'title' => 'Cinder Mantis Paste',
						'slug' => str_slug ( strtolower ( 'Cinder Mantis Paste' ) ),
						'consumable' => true,
						'effect' => 'You gain a single packet dealing 3 Fire damage.' 
				] );
		RawResource::create ( [ 
				'id' => 103,
				'value' => 30,
				'title' => 'Burroworm Meat',
				'slug' => str_slug ( strtolower ( 'Burroworm Meat' ) ),
				'consumable' => true,
				'effect' => 'Gain a single resist against an attack dealing 10 or less Earth damage, even if partnered with the True descriptor.' 
		] );
		RawResource::create ( [ 
				'id' => 104,
				'value' => 30,
				'title' => 'Coy-Moth Spores',
				'consumable' => true,
				'effect' => 'You gain a packet dealing 10 Poison damage.' 
		] );
		RawResource::create ( [ 
				'id' => 105,
				'value' => 15,
				'title' => 'Fire Fly Thorax',
				'slug' => str_slug ( strtolower ( 'Fire Fly Thorax' ) ),
				'consumable' => true,
				'effect' => 'You gain a packet dealing 5 Fire damage.' 
		] );
		RawResource::create ( [ 
				'id' => 106,
				'value' => 15,
				'title' => 'Lightning Bug Thorax',
				'slug' => str_slug ( strtolower ( 'Lightning Bug Thorax' ) ),
				'consumable' => true,
				'effect' => 'You gain a packet dealing 5 Lightning damage.' 
		] );
		RawResource::create ( 
				// Beasts of the Land
				// Common
				// Deer, Sheep and Goats
				// Meat
				[ 
						'id' => 107,
						'title' => 'Pelts',
						'slug' => str_slug ( strtolower ( 'Pelts' ) )/* Clothing, Tents */] );
		RawResource::create ( [ 
				'id' => 108,
				'title' => 'Wool',
				'slug' => str_slug ( strtolower ( 'Wool' ) )/* woolen Cloth */] );
		RawResource::create ( [ 
				'id' => 109,
				'title' => 'Sinew',
				'slug' => str_slug ( strtolower ( 'Sinew' ) )/* Bowstrings, Leatherworkings */] );
		RawResource::create ( [ 
				'id' => 110,
				'title' => 'Horn',
				'slug' => str_slug ( strtolower ( 'Horn' ) )/* Potions, Whittled goods */] );
		RawResource::create ( [ 
				'id' => 111,
				'title' => 'Milk',
				'slug' => str_slug ( strtolower ( 'Milk' ) )/* Cheese, Cookery */] );
		RawResource::create ( 
				// Cattle, Pigs and Oxen
				// Meat
				[ 
						'id' => 112,
						'title' => 'Bones',
						'slug' => str_slug ( strtolower ( 'Bones' ) )/* Soup and other various Whittled items */] );
		RawResource::create ( 
				// Leather
				[ 
						'id' => 113,
						'title' => 'Tallow',
						'slug' => str_slug ( strtolower ( 'Tallow' ) )/* Tents, Candles, frying Fish Filets */] );
		RawResource::create ( 
				// Milk
				[ 
						'id' => 114,
						'title' => 'Horn',
						'slug' => str_slug ( strtolower ( 'Horn' ) )/* Potions, Whittled goods */] );
		RawResource::create ( 
				// Reptiles
				// Meat
				// Leather
				[ 
						'id' => 115,
						'title' => 'Oil',
						'slug' => str_slug ( strtolower ( 'Oil' ) )/* Lamps, consumable */] );
		RawResource::create ( 
				// Felids and Canids
				[ 
						'id' => 116,
						'title' => 'Pelts',
						'slug' => str_slug ( strtolower ( 'Pelts' ) )/* Clothing, Tents */] );
		RawResource::create ( 
				// Rare
				[ 
						'id' => 117,
						'value' => 5,
						'title' => 'Skiff Milk',
						'slug' => str_slug ( strtolower ( 'Skiff Milk' ) ),
						'consumable' => true,
						'effect' => 'Heal 2 or remove 2 Poison damage.' 
				] );
		RawResource::create ( [ 
				'id' => 118,
				'value' => 5,
				'title' => 'Skiff Meat',
				'slug' => str_slug ( strtolower ( 'Skiff Meat' ) ),
				'consumable' => true,
				'effect' => 'Heal 5.' 
		] );
		RawResource::create ( [ 
				'id' => 119,
				'value' => 50,
				'title' => 'Tundra Cat Pelt',
				'slug' => str_slug ( strtolower ( 'Tundra Cat Pelt' ) ),
				'consumable' => true,
				'effect' => 'You gain +1 Defense for 1 hour.' 
		] );
		RawResource::create ( [ 
				'id' => 120,
				'value' => 20,
				'title' => 'Jade Wolf Shard',
				'slug' => str_slug ( strtolower ( 'Jade Wolf Shard' ) ),
				'consumable' => true,
				'effect' => 'While held in one hand, you may convert the damage type of the weapon' 
		] );
		RawResource::create ( [ 
				'id' => 121,
				'value' => 20,
				'title' => 'Tribbit Leg',
				'slug' => str_slug ( strtolower ( 'Tribbit Leg' ) ),
				'consumable' => true,
				'effect' => 'Gain a single resist against an attack dealing 10 or less Water damage, even if partnered with the True descriptor.' 
		] );
		RawResource::create ( [ 
				'id' => 122,
				'value' => 15,
				'title' => 'Tribbit Tongue',
				'slug' => str_slug ( strtolower ( 'Tribbit Tongue' ) ),
				'consumable' => true,
				'effect' => 'Deal 3 Acid damage by Pointcast.' 
		] );
		RawResource::create ( [ 
				'id' => 123,
				'value' => 25,
				'title' => 'Tribbit Eye',
				'slug' => str_slug ( strtolower ( 'Tribbit Eye' ) ),
				'consumable' => true,
				'effect' => 'You gain a packet dealing Dominate 10.' 
		] );
		RawResource::create ( [ 
				'id' => 124,
				'value' => 30,
				'title' => 'Barbkat Pelt',
				'slug' => str_slug ( strtolower ( 'Barbkat Pelt' ) ),
				'consumable' => true,
				'effect' => 'Deal 2 Piercing damage by melee range pointcast to any player who touches you or hits you with a one handed weapon for the next 10 mins.' 
		] );
		RawResource::create ( [ 
				'id' => 125,
				'value' => 20,
				'title' => 'Wind Constrictor Skin',
				'slug' => str_slug ( strtolower ( 'Wind Constrictor Skin' ) ),
				'consumable' => true,
				'effect' => 'Go Out of Game for up to 10 seconds.' 
		] );
		RawResource::create ( [ 
				'id' => 126,
				'value' => 20,
				'title' => 'Inferno Shark Meat',
				'slug' => str_slug ( strtolower ( 'Inferno Shark Meat' ) ),
				'consumable' => true,
				'effect' => 'Gain a single resist against an attack dealing 10 or less Fire damage, even if partnered with the True descriptor.' 
		] );
		RawResource::create ( [ 
				'id' => 127,
				'value' => 20,
				'title' => 'Dock Dog Core',
				'slug' => str_slug ( strtolower ( 'Dock Dog Core' ) ),
				'consumable' => true,
				'effect' => 'Gain a single resist against an attack dealing 10 or less Lightning damage, even if partnered with the True descriptor.' 
		] );
		RawResource::create ( [ 
				'id' => 128,
				'value' => 35,
				'title' => 'Bruiser Ape Heart',
				'slug' => str_slug ( strtolower ( 'Bruiser Ape Heart' ) ),
				'consumable' => true,
				'effect' => 'Gain a Feat of Strength.' 
		] );
		RawResource::create ( [ 
				'id' => 129,
				'value' => 20,
				'title' => 'Wind Constrictor Skin',
				'slug' => str_slug ( strtolower ( 'Wind Constrictor Skin' ) ),
				'consumable' => true,
				'effect' => 'Go Out of Game for up to 10 seconds.' 
		] );
		RawResource::create ( [ 
				'id' => 130,
				'value' => 15,
				'title' => 'Water Widow Venom',
				'slug' => str_slug ( strtolower ( 'Water Widow Venom' ) ),
				'consumable' => true,
				'effect' => 'You gain a packet dealing 5 Poison damage.' 
		] );
		RawResource::create ( 
				// Common
				[ 
						'id' => 131,
						'title' => 'Yeast',
						'slug' => str_slug ( strtolower ( 'Yeast' ) )/* Draughts, Bread */] );
	}
}
