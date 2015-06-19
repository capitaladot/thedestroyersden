<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SkillTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Skill::create([
			/* universal */
			['id'=>1,'title'=>'Supplementary','description'=>'You gain +5 maximum HP. This ability may be purchased twice.'],
			['id'=>2,'title'=>'Learn Language','description'=>'You can read, write, and speak a new language. There is a single language for each kingdom, and the ‘common tongue’, which is spoken on all of Xep. All players are considered to be able to speak this language.'],
			['id'=>3,'title'=>'Sailor','description'=>'With one grade you are able to properly man most small vessels alone, or assist a crew on a larger one. With two grades you are a great help aboard most vessels! With three grades you are Captain material. This will have role play and BGA purposes.'],
			['id'=>4,'title'=>'Orienteering','description'=>'You are capable of reading maps that are not encrypted.'],
			['id'=>5,'title'=>'Cartography','description'=>'You are able to create usable maps of the places you go. This is to be role played in order for the map to be considered accurate. Ideally you should be “drawing details” as you travel. When the adventure is over your character will receive an item card representing the map. If you purchase a second grade of this ability, whenever you make a map, you may create an encrypted map instead; an item usable only by you and those you trust with your encryption key. Requires: Orienteering'],
			['id'=>6,'title'=>'Tracking','description'=>'You can follow most things that travel on the ground. This ability will not be a requirement to accomplish most tasks or plots, but it certainly helps in some cases.'],
			['id'=>7,'title'=>'First Aid','description'=>'You know some basic medical knowledge. With a 60 second count, you can stabilize a target at 0 HP by touch. You can cut this time in half by having props such as gauze and other basic medical supplies to role play with while performing your count.'],
			['id'=>8,'title'=>'Folklore','description'=>'You know a vast amount of information about a particular subject, and will receive a packet of information that you can use to reflect it. You cannot share this information verbatim with anyone who does not also possess the same Lore, but you can share details that will help others to learn about them through role play; such as a weakness, or commonly used tactics. Choose from the following subjects: Demons, Undead, Magic, Wildlife, Elementals, The Pantheon, History, Races, and Cultures.'],
			['id'=>9,'title'=>'Math','description'=>'You can count really well! Everyone is capable of basic counting using their fingers and toes, but that is not enough to purchase goods and services without sometimes being ripped off by a greedy merchant.'],
			['id'=>10,'title'=>'Haggle','description'=>'When dealing with most merchants, you will roll a d6 once you have totaled your transaction, and reduce the final cost by the result. You must be spending at least 10 silver in order to use this ability. You must carry your own d6. Requires: Math'],
			['id'=>11,'title'=>'Crafter','description'=>'You are capable of building items by using Crafting Techniques. There are many to choose from, and each grouping has several techniques within it that you may pursue. For every purchase of a new Craft, a character gains two Crafting Techniques of their choice from that tree for free. Additional Crafting Techniques from that tree may be purchased for 1 XP each. (See Crafters Guide for further details)'],
			['id'=>12,'title'=>'Personal Trade ','description'=>'You own a mundane business, gaining you 5 silver per game at check in. You should roleplay or at least discuss this trade with other players occasionally.'],
			['id'=>13,'title'=>'Merchant','description'=>'Your small business has grown, and you are now more widely known for your wares. You begin with a neutral reputation, but this will change depending on how you interact with your customers and care for your business, especially in BGAs. You also gain 5 Silver per game. If you display your wares in game, NPCs are more likely to show up to browse and possibly purchase them. Requires: Personal Trade'],
			['id'=>14,'title'=>'Subdue','description'=>'Showing mercy to your enemies may come back around to help you. Once per Arc per grade, you can declare “Subdue” when a foe drops by your hand. That target is considered stabilized at zero HP. You are responsible for explaining this effect to your foes. This ability can be purchased any number of times.'],
			['id'=>15,'title'=>'Religious','description'=>'You may not be as devoted as a Cleric, but you have chosen to follow the ways of a particular deity, and they prefer to keep you alive. You gain a single Soul Orb item card. In turn, you must also follow the rules of your chosen deity as if you were a Cleric, or you will lose both of this ability. This ability may only be purchased once.'']
		]);
	}

}
