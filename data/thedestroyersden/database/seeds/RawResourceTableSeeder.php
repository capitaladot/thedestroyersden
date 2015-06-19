<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RawResourceTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *'],
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		RawResource::create([
			//Common
			//Rare
			//Mineral
			//Metal Ore
			['id'=>1,'title'=>'Iron Ore','slug'=>snake_case(strtolower('Iron Ore'))/* Iron, Steel, Stainless */],
			['id'=>2,'title'=>'Lead Ore','slug'=>snake_case(strtolower('Lead Ore'))/* Bullets, balanced Melee Weapons */],
			['id'=>3,'title'=>'Zinc Ore','slug'=>snake_case(strtolower('Zinc Ore'))/* Gunmetal, Superior Whetstones */],
			['id'=>4,'title'=>'Chromite Ore','slug'=>snake_case(strtolower('Chromite Ore'))/* Chromium */],
			['id'=>5,'title'=>'Copper Ore','slug'=>snake_case(strtolower('Copper Ore'))/* Copper, Bronze */],
			['id'=>6,'title'=>'Tin Ore','slug'=>snake_case(strtolower('Tin Ore'))/*(Tinker’s goods)*/],
			['id'=>7,'title'=>'Manganese Ore','slug'=>snake_case(strtolower('Manganese Ore'))/* Manganese */],
			['id'=>8,'title'=>'Gold Dust','slug'=>snake_case(strtolower('Gold Dust'))/* Gold */],
			['id'=>9,'title'=>'Silver Shavings','slug'=>snake_case(strtolower('Silver Shavings'))/* Silver */],
			//Components and Chemicals
			['id'=>10,'title'=>'Coal','slug'=>snake_case(strtolower('Coal'))/* smelting */],
			['id'=>11,'title'=>'Saltpeter','slug'=>snake_case(strtolower('Saltpeter'))/* Gunpowder */],
			['id'=>12,'title'=>'Clay','slug'=>snake_case(strtolower('Clay'))/* Ovens, Vessels, Superior Whetstones, Tiles */],
			['id'=>13,'title'=>'Water','slug'=>snake_case(strtolower('Water'))/* various Brews, Distillates, Potions, Soups, and Stews */],
			//Stone
			['id'=>14,'title'=>'Whetstone','slug'=>snake_case(strtolower('Whetstone'))/* sharpened Melee Weapons */],
			['id'=>15,'title'=>'Living Limestone','slug'=>snake_case(strtolower('Living Limestone'))/* Potions */],
			['id'=>16,'title'=>'Massidium','slug'=>snake_case(strtolower('Massidium'))/* Potions */],
			['id'=>17,'title'=>'Sand','slug'=>snake_case(strtolower('Sand'))/* glass */],
			//Gem Ore
			['id'=>18,'value'=>50,'title'=>'Garnet','slug'=>snake_case(strtolower('Garnet'))],
			['id'=>19,'value'=>60,'title'=>'Amethyst','slug'=>snake_case(strtolower('Amethyst'))],
			['id'=>20,'value'=>70,'title'=>'Ruby','slug'=>snake_case(strtolower('Ruby'))],
			['id'=>21,'value'=>80,'title'=>'Emerald','slug'=>snake_case(strtolower('Emerald'))],
			['id'=>22,'value'=>90,'title'=>'Sapphire','slug'=>snake_case(strtolower('Sapphire'))],
			['id'=>23,'value'=>100,'title'=>'Diamond','slug'=>snake_case(strtolower('Diamond'))],
			//Metal
			['id'=>24,'title'=>'Chromium','slug'=>snake_case(strtolower('Chromium'))/* Stainless */],
			['id'=>25,'title'=>'Steel','slug'=>snake_case(strtolower('Steel'))/* Hack Blades and Pierce Points, Crush Heads, various Tools */],
			['id'=>26,'title'=>'Manganese (particularly sharp and break-resistant blades)'],
			['id'=>27,'title'=>'Copper','slug'=>snake_case(strtolower('Copper'))/* gunmetal, vessels, flashing */],
			['id'=>28,'title'=>'Tin','slug'=>snake_case(strtolower('Tin'))/* Gunmetal, Vessels and Cooking Tools, flashing */],
			['id'=>29,'title'=>'Bronze','slug'=>snake_case(strtolower('Bronze'))/* gunsights, tools, crude Melee Weapons */],
			['id'=>30,'title'=>'Gold','slug'=>snake_case(strtolower('Gold'))/* bullets, weapon coatings */],
			['id'=>31,'title'=>'Silver','slug'=>snake_case(strtolower('Silver'))/* bullets, weapon coatings */],
			//Fruit
			//Of the Bush
			//Berries (consumable)
			//Common
			['id'=>32,'title'=>'Berries','slug'=>snake_case(strtolower('Berries')),'consumable'=>true,'effect'=>'Heal 2'],
			//Rare
			['id'=>33,'value'=>20,'title'=>'Fresh Grinnin Berries','slug'=>snake_case(strtolower('Fresh Grinnin Berries')),'consumable'=>true,'effect'=>'Deals Pacify 10 minutes when ingested.'],
			['id'=>34,'value'=>10,'title'=>'Dried Grinnin Berries','slug'=>snake_case(strtolower('Dried Grinnin Berries')),'consumable'=>true,'effect'=>'You become immune to Rage and Taunt for 10 minutes when ingested.'],
			['id'=>35,'title'=>'Leaves','slug'=>snake_case(strtolower('Leaves'))/* consumable */],
			//Rare
			['id'=>36,'value'=>5,'title'=>'Kaige Leaves','slug'=>snake_case(strtolower('Kaige Leaves')),'consumable'=>true,'effect'=>'You can remove the Stun effect from a target by touch.'],
			['id'=>37,'value'=>50,'title'=>'St. Elsewhere’s Leaves','consumable'=>true,'effect'=>'Go Out of Game for 10 Seconds.'],
			//Peppers
			//Common
			['id'=>38,'title'=>'Bell Pepper','slug'=>snake_case(strtolower('Bell Pepper'))/* Cookery */],
			['id'=>39,'title'=>'Sweet Pepper','slug'=>snake_case(strtolower('Sweet Pepper'))/* Cookery */],
			['id'=>40,'title'=>'Hot Pepper','slug'=>snake_case(strtolower('Hot Pepper'))/* Cookery */],
			//Rarities
			['id'=>41,'title'=>'Firepeppers','slug'=>snake_case(strtolower('Firepeppers')),'consumable'=>true,'effect'=>'Chewing for a 30 Count causes 3 Damage to the chewer, but grants a Melee Point Cast Fire Breath 5)'],
			//Of The Tree
			//Common
			['id'=>42,'title'=>'Apples','slug'=>snake_case(strtolower('Apples')),'consumable'=>true,'effect'=>'Heal 1'],
			['id'=>43,'title'=>'Citrus','slug'=>snake_case(strtolower('Citrus')),'consumable'=>true,'effect'=>'Heal 1'],
			['id'=>44,'title'=>'Pears','slug'=>snake_case(strtolower('Pears')),'consumable'=>true,'effect'=>'Heal 1'],
			//Rare
			['id'=>45,'value'=>5,'title'=>'Slaza Fruit','slug'=>snake_case(strtolower('Slaza Fruit')),'consumable'=>true,'effect'=>'Deals 5 Fire damage when ingested. You gain 1 Mana.'],
			//Of the Vine
			//Common
			['id'=>46,'title'=>'Grapes','slug'=>snake_case(strtolower('Grapes')),'consumable'=>true,'effect'=>'1 whole bunch Heal 2)'],
			//Rare
			['id'=>47,'value'=>5,'title'=>'Julmungo Melon','slug'=>snake_case(strtolower('Julmungo Melon')),'effect'=>'Enrage 1 Minute','consumable'=>true],
			['id'=>48,'value'=>40,'title'=>'Bitterfruit (Heal 1 per Encounter for the remainder of the Day)'],
			['id'=>49,'value'=>30,'title'=>'Sorcerous Speedberry (cast 1 Spell in half the time)'],
			//['id'=>,'title'=>'		Of the Meadow'],
			//['id'=>,'title'=>'		Rarities'],
			['id'=>50,'value'=>5,'title'=>'Elma Ivy','slug'=>snake_case(strtolower('Elma Ivy')),'consumable'=>true,'effect'=>'Heal 5 or remove 5 Poison damage.'],
			['id'=>51,'value'=>10,'title'=>'Volcano Grass','slug'=>snake_case(strtolower('Volcano Grass')),'consumable'=>true,'effect'=>'Deals Rage 30 when ingested.'],
			['id'=>52,'value'=>25,'title'=>'Selrit Stalk','slug'=>snake_case(strtolower('Selrit Stalk')),'consumable'=>true,'effect'=>'You can resist the Smash Limb effect once during the current day.'],
			['id'=>53,'value'=>60,'title'=>'Callidadis Flower','slug'=>snake_case(strtolower('Callidadis Flower')),'consumable'=>true,'effect'=>'You gain 1 Dodge.'],
			['id'=>54,'value'=>40,'title'=>'Chlora Pollen','slug'=>snake_case(strtolower('Chlora Pollen')),'consumable'=>true,'effect'=>'You gain a packet dealing Sleep 60.'],
			['id'=>55,'value'=>30,'title'=>'Silver Spinach','slug'=>snake_case(strtolower('Silver Spinach')),'consumable'=>true,'effect'=>'Removes the Weakness effect when ingested.'],
			['id'=>56,'value'=>20,'title'=>'Ink Lily','slug'=>snake_case(strtolower('Ink Lily')),'consumable'=>true,'effect'=>'a mana infused flower used for making ink for runes'],
			//Of The Earth
			//Common
			['id'=>57,'title'=>'Ginger','slug'=>snake_case(strtolower('Ginger'))/* Liqueurs */],
			['id'=>58,'title'=>'Onions','slug'=>snake_case(strtolower('Onions'))/* Cookery */],
			['id'=>59,'title'=>'Potatoes','slug'=>snake_case(strtolower('Potatoes'))/* Cookery */],
			['id'=>60,'title'=>'Turnips','slug'=>snake_case(strtolower('Turnips'))/* Cookery */],
			['id'=>61,'title'=>'Radishes','slug'=>snake_case(strtolower('Radishes'))/* Cookery */],
			['id'=>62,'title'=>'Carrots (Cookery','consumable'=>true,'effect'=>'Heal 1'],
			//Rare
			['id'=>63,'value'=>10,'title'=>'Fermented Brunis Root','slug'=>snake_case(strtolower('Fermented Brunis Root')),'consumable'=>true,'effect'=>' You gain a resist against the Weakness effect.)'],
			['id'=>64,'value'=>10,'title'=>'Dozer Cap','slug'=>snake_case(strtolower('Dozer Cap')),'consumable'=>true,'effect'=>' You gain a packet dealing Stun 10)'],
			['id'=>65,'value'=>50,'title'=>'Reddish','slug'=>snake_case(strtolower('Reddish')),'consumable'=>true,'effect'=>' Remove all Poison damage. You are immune to attacks using the Poison descriptor for 1 minute)'],
			['id'=>66,'value'=>15,'title'=>'Viper Stripe Mushroom','slug'=>snake_case(strtolower('Viper Stripe Mushroom')),'consumable'=>true,'effect'=>'You gain a packet dealing 5 Acid damage)'],
			['id'=>67,'value'=>15,'title'=>'Black Moss','slug'=>snake_case(strtolower('Black Moss')),'consumable'=>true,'effect'=>' Apply this to a single bow or melee weapon to convert its next attack to the Poison type)'],
			['id'=>68,'value'=>25,'title'=>'Blood Onion','slug'=>snake_case(strtolower('Blood Onion')),'consumable'=>true,'effect'=>' Deals 2 Life Drain when ingested).'],
			['id'=>69,'value'=>20,'title'=>'Sparkginger','slug'=>snake_case(strtolower('Sparkginger')),'consumable'=>true,'effect'=>' chewing for a 30 Count causes 3 Damage to the chewer, but grants a Melee Point Cast Lightning Breath 5)'],
			//Grain and Grass
			['id'=>70,'title'=>'Barley','slug'=>snake_case(strtolower('Barley'))/* Beer and Soup */],
			['id'=>71,'title'=>'Corn','slug'=>snake_case(strtolower('Corn'))/* Bread and Spirits */],
			['id'=>72,'title'=>'Flax','slug'=>snake_case(strtolower('Flax'))/* Linen Cloth, Twine */],
			['id'=>73,'title'=>'Hay','slug'=>snake_case(strtolower('Hay'))/* Animal feed */],
			['id'=>74,'title'=>'Maize','slug'=>snake_case(strtolower('Maize'))/* Bread and Spirits */],
			['id'=>75,'title'=>'Reeds','slug'=>snake_case(strtolower('Reeds'))/* Baskets */],
			['id'=>76,'title'=>'Straw','slug'=>snake_case(strtolower('Straw'))/* Roofing, Baskets, Animal feed */],
			['id'=>77,'title'=>'Wheat','slug'=>snake_case(strtolower('Wheat'))/* Bread, Beer, and Spirits */],
			//Herbs
			//Of the Vine
			['id'=>78,'title'=>'Hops','slug'=>snake_case(strtolower('Hops'))/* Beer */],
			//Of the Bark
			['id'=>79,'title'=>'Cinnamon','slug'=>snake_case(strtolower('Cinnamon'))/* Liqueur */],
			['id'=>80,'title'=>'Willow','slug'=>snake_case(strtolower('Willow'))/* Healing Potions */],
			//Of the Bush
			['id'=>81,'title'=>'Feverfew','slug'=>snake_case(strtolower('Feverfew'))/* Potions */],
			['id'=>82,'title'=>'Tea','slug'=>snake_case(strtolower('Tea'))/* healing Draughts */],
			['id'=>83,'title'=>'Seed','slug'=>snake_case(strtolower('Seed'))/* used by a Farmer to grow a Tree, Bush, Vine, or a Row of Grain or Grass */],
			//Wood (Barrels, simple Tools, Edifices, weapon parts
			['id'=>84,'title'=>'Ash','slug'=>snake_case(strtolower('Ash'))/* Hafts for Pole Weapons and other various Techniques */],
			['id'=>85,'title'=>'Cedar','slug'=>snake_case(strtolower('Cedar'))/* Arrow Shafts, Trunks to slow Entropy of Clothing */],
			['id'=>86,'title'=>'Oak','slug'=>snake_case(strtolower('Oak'))/* Charcoal, Bucklers and Targs, Gun Stocks */],
			['id'=>87,'title'=>'Yew','slug'=>snake_case(strtolower('Yew'))/* Staves for bows and other Wood Mechanisms */],
			['id'=>88,'title'=>'Charcoal','slug'=>snake_case(strtolower('Charcoal'))/* smelting, gunpowder */],
			['id'=>89,'title'=>'Cork','slug'=>snake_case(strtolower('Cork'))/* bottling */],
			//Animal
			//Poultry
			//Common
			['id'=>90,'title'=>'Meat','slug'=>snake_case(strtolower('Meat'))/* various Cuts */],
			['id'=>91,'title'=>'Feathers','slug'=>snake_case(strtolower('Feathers'))/* Fletchings, Bedding */],
			['id'=>92,'title'=>'Tallow','slug'=>snake_case(strtolower('Tallow'))/* Tents, Candles */],
			['id'=>93,'title'=>'Eggs','slug'=>snake_case(strtolower('Eggs'))/* Cookery items, consumable */],
			['id'=>94,'title'=>'Leather','slug'=>snake_case(strtolower('Leather'))/* Weapon Grips, Sheaths, Targs, Quivers and Bucklers */],
			//Fish'],
			//Common
			['id'=>95,'title'=>'Filets','slug'=>snake_case(strtolower('Filets')),'consumable'=>true,'effect'=>'Heal 2'],
			['id'=>96,'title'=>'Oil (Lamps,','consumable'=>true],
			//Sharks, Rays, and Skates
			//Filets
			//Oil
			//Leather
			//Rare
			['id'=>97,'value'=>10,'title'=>'Tacc Fish','slug'=>snake_case(strtolower('Tacc Fish')),'consumable'=>true,'effect'=>'Gain 1 Mana.'],
			['id'=>98,'value'=>10,'title'=>'Hissing Blackfish','slug'=>snake_case(strtolower('Hissing Blackfish')),'consumable'=>true,'effect'=>'Remove 5 Poison damage.'],
			['id'=>99,'value'=>10,'title'=>'Silma Fish','slug'=>snake_case(strtolower('Silma Fish')),'consumable'=>true,'effect'=>'Remove a single status effect.'],
			//Insects and Arachnids
			//Common
			//Bees
			['id'=>100,'title'=>'Honey','slug'=>snake_case(strtolower('Honey')),'consumable'=>true,'effect'=>'Heal 1)'/*Mead, Compresses*/],
			['id'=>101,'title'=>'Wax','slug'=>snake_case(strtolower('Wax'))/* sealing Bottles */],
			//Rare
			['id'=>102,'value'=>10,'title'=>'Cinder Mantis Paste','slug'=>snake_case(strtolower('Cinder Mantis Paste')),'consumable'=>true,'effect'=>'You gain a single packet dealing 3 Fire damage.'],
			['id'=>103,'value'=>30,'title'=>'Burroworm Meat','slug'=>snake_case(strtolower('Burroworm Meat')),'consumable'=>true,'effect'=>'Gain a single resist against an attack dealing 10 or less Earth damage, even if partnered with the True descriptor.'],
			['id'=>104,'value'=>30,'title'=>'Coy-Moth Spores','consumable'=>true,'effect'=>'You gain a packet dealing 10 Poison damage.'],
			['id'=>105,'value'=>15,'title'=>'Fire Fly Thorax','slug'=>snake_case(strtolower('Fire Fly Thorax')),'consumable'=>true,'effect'=>'You gain a packet dealing 5 Fire damage.'],
			['id'=>106,'value'=>15,'title'=>'Lightning Bug Thorax','slug'=>snake_case(strtolower('Lightning Bug Thorax')),'consumable'=>true,'effect'=>'You gain a packet dealing 5 Lightning damage.'],
			//Beasts of the Land
			//Common
			//Deer, Sheep and Goats
			//Meat
			['id'=>107,'title'=>'Pelts','slug'=>snake_case(strtolower('Pelts'))/* Clothing, Tents */],
			['id'=>108,'title'=>'Wool','slug'=>snake_case(strtolower('Wool'))/* woolen Cloth */],
			['id'=>109,'title'=>'Sinew','slug'=>snake_case(strtolower('Sinew'))/* Bowstrings, Leatherworkings */],
			['id'=>110,'title'=>'Horn','slug'=>snake_case(strtolower('Horn'))/* Potions, Whittled goods */],
			['id'=>111,'title'=>'Milk','slug'=>snake_case(strtolower('Milk'))/* Cheese, Cookery */],
			//Cattle, Pigs and Oxen
			//Meat
			['id'=>112,'title'=>'Bones','slug'=>snake_case(strtolower('Bones'))/* Soup and other various Whittled items */],
			//Leather
			['id'=>113,'title'=>'Tallow','slug'=>snake_case(strtolower('Tallow'))/* Tents, Candles, frying Fish Filets */],
			//Milk
			['id'=>114,'title'=>'Horn','slug'=>snake_case(strtolower('Horn'))/* Potions, Whittled goods */],
			//Reptiles
			//Meat
			//Leather
			['id'=>115,'title'=>'Oil','slug'=>snake_case(strtolower('Oil'))/* Lamps, consumable */],
			//Felids and Canids
			['id'=>116,'title'=>'Pelts','slug'=>snake_case(strtolower('Pelts'))/* Clothing, Tents */],
			//Rare
			['id'=>117,'value'=>5,'title'=>'Skiff Milk','slug'=>snake_case(strtolower('Skiff Milk')),'consumable'=>true,'effect'=>'Heal 2 or remove 2 Poison damage.'],
			['id'=>118,'value'=>5,'title'=>'Skiff Meat','slug'=>snake_case(strtolower('Skiff Meat')),'consumable'=>true,'effect'=>'Heal 5.'],
			['id'=>119,'value'=>50,'title'=>'Tundra Cat Pelt','slug'=>snake_case(strtolower('Tundra Cat Pelt')),'consumable'=>true,'effect'=>'You gain +1 Defense for 1 hour.'],
			['id'=>120,'value'=>20,'title'=>'Jade Wolf Shard','slug'=>snake_case(strtolower('Jade Wolf Shard')),'consumable'=>true,'effect'=>'While held in one hand, you may convert the damage type of the weapon'],
			['id'=>121,'value'=>20,'title'=>'Tribbit Leg','slug'=>snake_case(strtolower('Tribbit Leg')),'consumable'=>true,'effect'=>'Gain a single resist against an attack dealing 10 or less Water damage, even if partnered with the True descriptor.'],
			['id'=>122,'value'=>15,'title'=>'Tribbit Tongue','slug'=>snake_case(strtolower('Tribbit Tongue')),'consumable'=>true,'effect'=>'Deal 3 Acid damage by Pointcast.'],
			['id'=>123,'value'=>25,'title'=>'Tribbit Eye','slug'=>snake_case(strtolower('Tribbit Eye')),'consumable'=>true,'effect'=>'You gain a packet dealing Dominate 10.'],
			['id'=>124,'value'=>30,'title'=>'Barbkat Pelt','slug'=>snake_case(strtolower('Barbkat Pelt')),'consumable'=>true,'effect'=>'Deal 2 Piercing damage by melee range pointcast to any player who touches you or hits you with a one handed weapon for the next 10 mins.'],
			['id'=>125,'value'=>20,'title'=>'Wind Constrictor Skin','slug'=>snake_case(strtolower('Wind Constrictor Skin')),'consumable'=>true,'effect'=>'Go Out of Game for up to 10 seconds.'],
			['id'=>126,'value'=>20,'title'=>'Inferno Shark Meat','slug'=>snake_case(strtolower('Inferno Shark Meat')),'consumable'=>true,'effect'=>'Gain a single resist against an attack dealing 10 or less Fire damage, even if partnered with the True descriptor.'],
			['id'=>127,'value'=>20,'title'=>'Dock Dog Core','slug'=>snake_case(strtolower('Dock Dog Core')),'consumable'=>true,'effect'=>'Gain a single resist against an attack dealing 10 or less Lightning damage, even if partnered with the True descriptor.'],
			['id'=>128,'value'=>35,'title'=>'Bruiser Ape Heart','slug'=>snake_case(strtolower('Bruiser Ape Heart')),'consumable'=>true,'effect'=>'Gain a Feat of Strength.'],
			['id'=>129,'value'=>20,'title'=>'Wind Constrictor Skin','slug'=>snake_case(strtolower('Wind Constrictor Skin')),'consumable'=>true,'effect'=>'Go Out of Game for up to 10 seconds.'],
			['id'=>130,'value'=>15,'title'=>'Water Widow Venom','slug'=>snake_case(strtolower('Water Widow Venom')),'consumable'=>true,'effect'=>'You gain a packet dealing 5 Poison damage.'],
			//Common
			['id'=>131,'title'=>'Yeast','slug'=>snake_case(strtolower('Yeast'))/* Draughts, Bread */]
		]);
	}
}
