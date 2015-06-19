<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Taggable;
class TaggableTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		Taggable::create ( 
				// ['id'=>,'Mineral Metal Ore']);Taggable::create(
				[ 
						'id' => 1,
						'title' => 'Iron Ore (Iron, Steel, Stainless)' 
				] );
		Taggable::create ( [ 
				'id' => 2,
				'title' => 'Lead Ore (Bullets, balanced Melee Weapons)' 
		] );
		Taggable::create ( [ 
				'id' => 3,
				'title' => 'Zinc Ore (Gunmetal, Superior Whetstones)' 
		] );
		Taggable::create ( [ 
				'id' => 4,
				'title' => 'Chromite Ore (Chromium)' 
		] );
		Taggable::create ( [ 
				'id' => 5,
				'title' => 'Copper Ore (Copper, Bronze)' 
		] );
		Taggable::create ( [ 
				'id' => 6,
				'title' => 'Tin Ore (Tinker’s goods)' 
		] );
		Taggable::create ( [ 
				'id' => 7,
				'title' => 'Manganese Ore (Manganese)' 
		] );
		Taggable::create ( [ 
				'id' => 8,
				'title' => 'Gold Dust (Gold)' 
		] );
		Taggable::create ( [ 
				'id' => 9,
				'title' => 'Silver Shavings (Silver)' 
		] );
		Taggable::create ( 
				// Mineral: Components and Chemicals
				[ 
						'id' => 10,
						'title' => 'Coal (smelting)' 
				] );
		Taggable::create ( [ 
				'id' => 11,
				'title' => 'Saltpeter (Gunpowder)' 
		] );
		Taggable::create ( [ 
				'id' => 12,
				'title' => 'Clay (Ovens, Vessels, Superior Whetstones, Tiles)' 
		] );
		Taggable::create ( [ 
				'id' => 13,
				'title' => 'Water (various Brews, Distillates, Potions, Soups, and Stews)' 
		] );
		Taggable::create ( 
				// Mineral: Stone
				[ 
						'id' => 14,
						'title' => 'Whetstone (sharpened Melee Weapons)' 
				] );
		Taggable::create ( [ 
				'id' => 15,
				'title' => 'Living Limestone (Potions)' 
		] );
		Taggable::create ( [ 
				'id' => 16,
				'title' => 'Massidium (Potions)' 
		] );
		Taggable::create ( [ 
				'id' => 17,
				'title' => 'Sand (glass)' 
		] );
		Taggable::create ( 
				// Mineral: Gem Ore
				[ 
						'id' => 18,
						'title' => '50 Silver - Garnet' 
				] );
		Taggable::create ( [ 
				'id' => 19,
				'title' => '60 Silver - Amethyst' 
		] );
		Taggable::create ( [ 
				'id' => 20,
				'title' => '70 Silver - Ruby' 
		] );
		Taggable::create ( [ 
				'id' => 21,
				'title' => '80 Silver - Emerald' 
		] );
		Taggable::create ( [ 
				'id' => 22,
				'title' => '90 Silver - Sapphire' 
		] );
		Taggable::create ( [ 
				'id' => 23,
				'title' => '100 Silver - Diamond' 
		] );
		Taggable::create ( 
				// Mineral: Metal
				[ 
						'id' => 24,
						'title' => 'Chromium (Stainless)' 
				] );
		Taggable::create ( [ 
				'id' => 25,
				'title' => 'Steel (Hack Blades and Pierce Points, Crush Heads, various Tools)' 
		] );
		Taggable::create ( [ 
				'id' => 26,
				'title' => 'Manganese (particularly sharp and break-resistant blades)' 
		] );
		Taggable::create ( [ 
				'id' => 27,
				'title' => 'Copper (gunmetal, vessels, flashing)' 
		] );
		Taggable::create ( [ 
				'id' => 28,
				'title' => 'Tin (Gunmetal, Vessels and Cooking Tools, flashing)' 
		] );
		Taggable::create ( [ 
				'id' => 29,
				'title' => 'Bronze (gunsights, tools, crude Melee Weapons)' 
		] );
		Taggable::create ( [ 
				'id' => 30,
				'title' => 'Gold (bullets, weapon coatings)' 
		] );
		Taggable::create ( [ 
				'id' => 31,
				'title' => 'Silver (bullets, weapon coatings)' 
		] );
		Taggable::create ( 
				// Plant
				// ['id'=>,'title'=>' Fruit']);Taggable::create(
				// ['id'=>,'title'=>' Of the Bush']);Taggable::create(
				[ 
						'id' => 32,
						'title' => 'Berries (consumable)' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Common']);Taggable::create(
				[ 
						'id' => 33,
						'title' => 'Consumable; Heal 2' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rare']);Taggable::create(
				[ 
						'id' => 34,
						'title' => '20 Silver - Fresh Grinnin Berries - Deals Pacify 10 minutes when ingested.' 
				] );
		Taggable::create ( [ 
				'id' => 35,
				'title' => '10 Silver - Dried Grinnin Berries - You become immune to Rage and Taunt for 10 minutes when ingested.' 
		] );
		Taggable::create ( [ 
				'id' => 36,
				'title' => 'Leaves (consumable)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rare']);Taggable::create(
				[ 
						'id' => 37,
						'title' => '5 Silver - Kaige Leaves - You can remove the Stun effect from a target by touch.' 
				] );
		Taggable::create ( [ 
				'id' => 38,
				'title' => '50 Silver - St. Elsewhere’s Leaves - Go Out of Game for 10 Seconds.' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Peppers']);Taggable::create(
				// ['id'=>,'title'=>' Common']);Taggable::create(
				[ 
						'id' => 39,
						'title' => 'Bell Pepper (Cookery)' 
				] );
		Taggable::create ( [ 
				'id' => 40,
				'title' => 'Sweet Pepper (Cookery)' 
		] );
		Taggable::create ( [ 
				'id' => 41,
				'title' => 'Hot Pepper (Cookery)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>'Rare']);Taggable::create(
				[ 
						'id' => 42,
						'title' => 'Firepeppers (Consumable;  chewing for a 30 Count causes 3 Damage to the chewer, but grants a Melee Point Cast Fire Breath 5)' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Of The Tree']);Taggable::create(
				// ['id'=>,'title'=>' Common']);Taggable::create(
				[ 
						'id' => 43,
						'title' => 'Apples (Cider, consumable; Heal 1)' 
				] );
		Taggable::create ( [ 
				'id' => 44,
				'title' => 'Citrus (Oil, consumable; Heal 1)' 
		] );
		Taggable::create ( [ 
				'id' => 45,
				'title' => 'Pears (Cider, consumable; Heal 1)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rarities']);Taggable::create(
				[ 
						'id' => 46,
						'title' => '5 Silver - Slaza Fruit - Deals 5 Fire damage when ingested. You gain 1 Mana.' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Of the Vine']);Taggable::create(
				// ['id'=>,'title'=>' Common']);Taggable::create(
				[ 
						'id' => 47,
						'title' => 'Grapes (Wine, consumable; 1 whole bunch Heal 2)' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rarities']);Taggable::create(
				[ 
						'id' => 48,
						'title' => '5 Silver - Julmungo Melon (Enrage 1 Minute)' 
				] );
		Taggable::create ( [ 
				'id' => 49,
				'title' => '40 Silver - Bitterfruit (Heal 1 per Encounter for the remainder of the Day)' 
		] );
		Taggable::create ( [ 
				'id' => 50,
				'title' => '30 Silver - Sorcerous Speedberry (cast 1 Spell in half the time)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Of the Meadow']);Taggable::create(
				// ['id'=>,'title'=>' Rarities']);Taggable::create(
				[ 
						'id' => 51,
						'title' => '5 Silver - Elma Ivy - Heal 5 or remove 5 Poison damage.' 
				] );
		Taggable::create ( [ 
				'id' => 52,
				'title' => '10 Silver - Volcano Grass - Deals Rage 30 when ingested.' 
		] );
		Taggable::create ( [ 
				'id' => 53,
				'title' => '25 Silver - Selrit Stalk - You can resist the Smash Limb effect once during the current day.' 
		] );
		Taggable::create ( [ 
				'id' => 54,
				'title' => '60 Silver - Callidadis Flower - You gain 1 Dodge.' 
		] );
		Taggable::create ( [ 
				'id' => 55,
				'title' => '40 Silver - Chlora Pollen - You gain a packet dealing Sleep 60.' 
		] );
		Taggable::create ( [ 
				'id' => 56,
				'title' => '30 Silver - Silver Spinach - Removes the Weakness effect when ingested.' 
		] );
		Taggable::create ( [ 
				'id' => 57,
				'title' => '20 Silver - Ink Lily - a mana infused flower used for making ink for runes' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Of The Earth']);Taggable::create(
				// ['id'=>,'title'=>' Common']);Taggable::create(
				[ 
						'id' => 58,
						'title' => 'Ginger (Liqueurs)' 
				] );
		Taggable::create ( [ 
				'id' => 59,
				'title' => 'Onions (Cookery)' 
		] );
		Taggable::create ( [ 
				'id' => 60,
				'title' => 'Potatoes (Cookery)' 
		] );
		Taggable::create ( [ 
				'id' => 61,
				'title' => 'Turnips (Cookery)' 
		] );
		Taggable::create ( [ 
				'id' => 62,
				'title' => 'Radishes (Cookery)' 
		] );
		Taggable::create ( [ 
				'id' => 63,
				'title' => 'Carrots (Cookery; Consumable, Heal 1)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rarities']);Taggable::create(
				[ 
						'id' => 64,
						'title' => '10 Silver - Fermented Brunis Root (Consumable;  You gain a resist against the Weakness effect.)' 
				] );
		Taggable::create ( [ 
				'id' => 65,
				'title' => '10 Silver - Dozer Cap (Consumable;  You gain a packet dealing Stun 10)' 
		] );
		Taggable::create ( [ 
				'id' => 66,
				'title' => '50 Silver - Reddish (Consumable;  Remove all Poison damage. You are immune to attacks using the Poison descriptor for 1 minute)' 
		] );
		Taggable::create ( [ 
				'id' => 67,
				'title' => '15 Silver - Viper Stripe Mushroom - You gain a packet dealing 5 Acid damage)' 
		] );
		Taggable::create ( [ 
				'id' => 68,
				'title' => '15 Silver - Black Moss (Consumable;  Apply this to a single bow or melee weapon to convert its next attack to the Poison type)' 
		] );
		Taggable::create ( [ 
				'id' => 69,
				'title' => '25 Silver - Blood Onion (Consumable;  Deals 2 Life Drain when ingested).' 
		] );
		Taggable::create ( [ 
				'id' => 70,
				'title' => '20 Silver - Sparkginger (Consumable;  chewing for a 30 Count causes 3 Damage to the chewer, but grants a Melee Point Cast Lightning Breath 5)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Grain and Grass']);Taggable::create(
				[ 
						'id' => 71,
						'title' => 'Barley (Beer and Soup)' 
				] );
		Taggable::create ( [ 
				'id' => 72,
				'title' => 'Corn (Bread and Spirits)' 
		] );
		Taggable::create ( [ 
				'id' => 73,
				'title' => 'Flax (Linen Cloth, Twine)' 
		] );
		Taggable::create ( [ 
				'id' => 74,
				'title' => 'Hay (Animal feed)' 
		] );
		Taggable::create ( [ 
				'id' => 75,
				'title' => 'Maize (Bread and Spirits)' 
		] );
		Taggable::create ( [ 
				'id' => 76,
				'title' => 'Reeds (Baskets)' 
		] );
		Taggable::create ( [ 
				'id' => 77,
				'title' => 'Straw (Roofing, Baskets, Animal feed)' 
		] );
		Taggable::create ( [ 
				'id' => 78,
				'title' => 'Wheat (Bread, Beer, and Spirits)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Herbs']);Taggable::create(
				// ['id'=>,'title'=>' Of the Vine']);Taggable::create(
				[ 
						'id' => 79,
						'title' => 'Hops (Beer)' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Of the Bark']);Taggable::create(
				[ 
						'id' => 80,
						'title' => 'Cinnamon (Liqueur)' 
				] );
		Taggable::create ( [ 
				'id' => 81,
				'title' => 'Willow (Healing Potions)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Of the Bush']);Taggable::create(
				[ 
						'id' => 82,
						'title' => 'Feverfew (Potions)' 
				] );
		Taggable::create ( [ 
				'id' => 83,
				'title' => 'Tea (healing Draughts)' 
		] );
		Taggable::create ( [ 
				'id' => 84,
				'title' => 'Seed (used by a Farmer to grow a Tree, Bush, Vine, or a Row of Grain or Grass)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>'Wood (Barrels, simple Tools, Edifices, weapon parts)']);Taggable::create(
				[ 
						'id' => 85,
						'title' => 'Ash (Hafts for Pole Weapons and other various Techniques)' 
				] );
		Taggable::create ( [ 
				'id' => 86,
				'title' => 'Cedar (Arrow Shafts, Trunks to slow Entropy of Clothing)' 
		] );
		Taggable::create ( [ 
				'id' => 87,
				'title' => 'Oak (Charcoal, Bucklers and Targs, Gun Stocks)' 
		] );
		Taggable::create ( [ 
				'id' => 88,
				'title' => 'Yew (Staves for bows and other Wood Mechanisms)' 
		] );
		Taggable::create ( [ 
				'id' => 89,
				'title' => 'Charcoal (smelting, gunpowder)' 
		] );
		Taggable::create ( [ 
				'id' => 90,
				'title' => 'Cork (bottling)' 
		] );
		Taggable::create ( 
				// Animal
				// ['id'=>,'title'=>' Poultry']);Taggable::create(
				// ['id'=>,'title'=>' Basics']);Taggable::create(
				[ 
						'id' => 91,
						'title' => 'Meat (various Cuts)' 
				] );
		Taggable::create ( [ 
				'id' => 92,
				'title' => 'Feathers (Fletchings, Bedding)' 
		] );
		Taggable::create ( [ 
				'id' => 93,
				'title' => 'Tallow (Tents, Candles)' 
		] );
		Taggable::create ( [ 
				'id' => 94,
				'title' => 'Eggs (Cookery items, consumable)' 
		] );
		Taggable::create ( [ 
				'id' => 95,
				'title' => 'Leather (Weapon Grips, Sheaths, Targs, Quivers and Bucklers)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>'Fish']);Taggable::create(
				// ['id'=>,'title'=>'Animal Basics']);Taggable::create(
				[ 
						'id' => 96,
						'title' => 'Filets (Food; Heal 2)' 
				] );
		Taggable::create ( [ 
				'id' => 97,
				'title' => 'Oil (Lamps, Consumable)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>'Sharks, Rays, and Skates']);Taggable::create(
				[ 
						'id' => 98,
						'title' => 'Filets (Food; Heal 2)' 
				] );
		Taggable::create ( [ 
				'id' => 99,
				'title' => 'Oil (Lamps, Consumable)' 
		] );
		Taggable::create ( [ 
				'id' => 100,
				'title' => 'Leather (Weapon Grips, Sheaths, Targs, Quivers and Bucklers)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>'Rarities']);Taggable::create(
				[ 
						'id' => 101,
						'title' => '10 Silver - Tacc Fish - Gain 1 Mana.' 
				] );
		Taggable::create ( [ 
				'id' => 102,
				'title' => '10 Silver - Hissing Blackfish - Remove 5 Poison damage.' 
		] );
		Taggable::create ( [ 
				'id' => 103,
				'title' => '10 Silver - Silma Fish - Remove a single status effect.' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Insects and Arachnids']);Taggable::create(
				// ['id'=>,'title'=>' Common']);Taggable::create(
				// ['id'=>,'title'=>'Bees']);Taggable::create(
				[ 
						'id' => 104,
						'title' => 'Honey (Mead, Compresses, Consumable; Heal 1)' 
				] );
		Taggable::create ( [ 
				'id' => 106,
				'title' => 'Wax (sealing Bottles)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rare']);Taggable::create(
				[ 
						'id' => 107,
						'title' => '10 Silver - Cinder Mantis Paste - You gain a single packet dealing 3 Fire damage.' 
				] );
		Taggable::create ( [ 
				'id' => 108,
				'title' => '30 Silver - Burroworm Meat - Gain a single resist against an attack dealing 10 or less Earth damage, even if partnered with the True descriptor.' 
		] );
		Taggable::create ( [ 
				'id' => 108,
				'title' => '30 Silver - Coy-Moth Spores - You gain a packet dealing 10 Poison damage.' 
		] );
		Taggable::create ( [ 
				'id' => 109,
				'title' => '15 Silver - Fire Fly Thorax - You gain a packet dealing 5 Fire damage.' 
		] );
		Taggable::create ( [ 
				'id' => 110,
				'title' => '15 Silver - Lightning Bug Thorax - You gain a packet dealing 5 Lightning damage.' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Beasts of the Land']);Taggable::create(
				// ['id'=>,'title'=>' Common']);Taggable::create(
				[ 
						'id' => 111,
						'title' => 'Deer, Sheep and Goats' 
				] );
		Taggable::create ( [ 
				'id' => 112,
				'title' => 'Animal		Meat (various Cuts)' 
		] );
		Taggable::create ( [ 
				'id' => 113,
				'title' => 'Animal		Pelts (Clothing, Tents)' 
		] );
		Taggable::create ( [ 
				'id' => 114,
				'title' => 'Animal		Wool (woolen Cloth)' 
		] );
		Taggable::create ( [ 
				'id' => 115,
				'title' => 'Animal		Sinew (Bowstrings, Leatherworkings)' 
		] );
		Taggable::create ( [ 
				'id' => 116,
				'title' => 'Animal		Horn (Potions, Whittled goods)' 
		] );
		Taggable::create ( [ 
				'id' => 117,
				'title' => 'Animal		Milk (Cheese, Cookery)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Cattle, Pigs and Oxen']);Taggable::create(
				[ 
						'id' => 118,
						'title' => 'Animal		Meat (various Cuts)' 
				] );
		Taggable::create ( [ 
				'id' => 119,
				'title' => 'Animal		Bones (Soup and other various Whittled items)' 
		] );
		Taggable::create ( [ 
				'id' => 120,
				'title' => 'Animal		Leather (Weapon Grips, Sheaths, Targs, Quivers and Bucklers)' 
		] );
		Taggable::create ( [ 
				'id' => 121,
				'title' => 'Animal		Tallow (Tents, Candles, frying Fish Filets)' 
		] );
		Taggable::create ( [ 
				'id' => 122,
				'title' => 'Animal		Milk (Cheese, Cookery)' 
		] );
		Taggable::create ( [ 
				'id' => 123,
				'title' => 'Animal		Horn (Potions, Whittled goods)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Reptiles']);Taggable::create(
				[ 
						'id' => 124,
						'title' => 'Animal		Meat (various Cuts)' 
				] );
		Taggable::create ( [ 
				'id' => 125,
				'title' => 'Animal		Leather (Weapon Grips, Sheaths, Targs, Quivers and Bucklers)' 
		] );
		Taggable::create ( [ 
				'id' => 126,
				'title' => 'Animal		Oil (Lamps, consumable)' 
		] );
		Taggable::create ( 
				// ['id'=>,'title'=>'Animal Felids and Canids']);Taggable::create(
				[ 
						'id' => 127,
						'title' => 'Animal		Pelts (Clothing, Tents)' 
				] );
		Taggable::create ( 
				// ['id'=>,'title'=>' Rarities']);Taggable::create(
				[ 
						'id' => 128,
						'title' => 'Animal		5 Silver - Skiff Milk - Heal 2 or remove 2 Poison damage.' 
				] );
		Taggable::create ( [ 
				'id' => 129,
				'title' => 'Animal		5 Silver - Skiff Meat - Heal 5.' 
		] );
		Taggable::create ( [ 
				'id' => 130,
				'title' => 'Animal		50 Silver - Tundra Cat Pelt - You gain +1 Defense for 1 hour.' 
		] );
		Taggable::create ( [ 
				'id' => 131,
				'title' => 'Animal		20 Silver - Jade Wolf Shard - While held in one hand, you may convert the damage type of the weapon' 
		] );
		Taggable::create ( [ 
				'id' => 132,
				'title' => 'Animal		20 Silver - Tribbit Leg - Gain a single resist against an attack dealing 10 or less Water damage, even if partnered with the True descriptor.' 
		] );
		Taggable::create ( [ 
				'id' => 133,
				'title' => 'Animal		15 Silver - Tribbit Tongue - Deal 3 Acid damage by Pointcast.' 
		] );
		Taggable::create ( [ 
				'id' => 134,
				'title' => 'Animal		25 Silver - Tribbit Eye - You gain a packet dealing Dominate 10.' 
		] );
		Taggable::create ( [ 
				'id' => 135,
				'title' => 'Animal		30 Silver - Barbkat Pelt - Deal 2 Piercing damage by melee range pointcast to any player who touches you or hits you with a one handed weapon for the next 10 mins.' 
		] );
		Taggable::create ( [ 
				'id' => 136,
				'title' => 'Animal		20 Silver - Wind Constrictor Skin - Go Out of Game for up to 10 seconds.' 
		] );
		Taggable::create ( [ 
				'id' => 137,
				'title' => 'Animal		20 Silver - Inferno Shark Meat - Gain a single resist against an attack dealing 10 or less Fire damage, even if partnered with the True descriptor.' 
		] );
		Taggable::create ( [ 
				'id' => 138,
				'title' => 'Animal		20 Silver - Dock Dog Core - Gain a single resist against an attack dealing 10 or less Lightning damage, even if partnered with the True descriptor.' 
		] );
		Taggable::create ( [ 
				'id' => 139,
				'title' => 'Animal		35 Silver - Bruiser Ape Heart - Gain a Feat of Strength.' 
		] );
		Taggable::create ( [ 
				'id' => 140,
				'title' => 'Animal		20 Silver - Wind Constrictor Skin - Go Out of Game for up to 10 seconds.' 
		] );
		Taggable::create ( [ 
				'id' => 141,
				'title' => 'Animal		15 Silver - Water Widow Venom - You gain a packet dealing 5 Poison damage.' 
		] );
		Taggable::create ( [ 
				'id' => 142,
				'title' => 'Animal		Yeast (Draughts, Bread)' 
		] );
	}
}