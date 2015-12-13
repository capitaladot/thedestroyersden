<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Tool;
use App\ItemType;

class ToolTableSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard ();
		$tools =[ [ 
				"title" => "Tools and Dies",
				"slug" => str_slug ( "Tools and Dies" ) 
		],
		 [ 
				"title" => "Gun Barrel Brush",
				"slug" => str_slug ( "Gun Barrel Brush" ) 
		],
		 [ 
				"title" => "Erector's Set",
				"slug" => str_slug ( "Erector's Set" ) 
		],
		 [ 
				"title" => "Glasser's Gear",
				"slug" => str_slug ( "Glasser's Gear" ) 
		],
		 [ 
				"title" => "Bullet Mold",
				"slug" => str_slug ( "Bullet Mold" ) 
		],
		 [ 
				"title" => "Crow's Bar",
				"slug" => str_slug ( "Crow's Bar" ) 
		],
		 [ 
				"title" => "Gemcutter",
				"slug" => str_slug ( "Gemcutter" ) 
		],
		 [ 
				"title" => "Tiny Tools",
				"slug" => str_slug ( "Tiny Tools" ) 
		],
		 [ 
				"title" => "Stonecutter",
				"slug" => str_slug ( "Stonecutter" ) 
		],
		 [ 
				"title" => "Tinker's Templates",
				"slug" => str_slug ( "Tinker's Templates" ) 
		],
		 [ 
				"title" => "Bark Scraper",
				"slug" => str_slug ( "Bark Scraper" ) 
		],
		 [ 
				"title" => "Woodsman's Axe",
				"slug" => str_slug ( "Woodsman's Axe" ) 
		],
		 [ 
				"title" => "Whittling Knife",
				"slug" => str_slug ( "Whittling Knife" ) 
		],
		 [ 
				"title" => "Knitting Needles",
				"slug" => str_slug ( "Knitting Needles" ) 
		],
		 [ 
				"title" => "Loom",
				"slug" => str_slug ( "Loom" ) 
		],
		 [ 
				"title" => "Sewing Awl",
				"slug" => str_slug ( "Sewing Awl" ) 
		],
		 [ 
				"title" => "Hat Mold",
				"slug" => str_slug ( "Hat Mold" ) 
		],
		 [ 
				"title" => "Sawyer's Saw",
				"slug" => str_slug ( "Sawyer's Saw" ) 
		],
		 [ 
				"title" => "Spinning Wheel",
				"slug" => str_slug ( "Spinning Wheel" ) 
		],
		 [ 
				"title" => "Still",
				"slug" => str_slug ( "Still" ) 
		],
		 [ 
				"title" => "Filet Knife",
				"slug" => str_slug ( "Filet Knife" ) 
		],
		 [ 
				"title" => "Butcher's Cleaver ",
				"slug" => str_slug ( "Butcher's Cleaver " ) 
		],
		 [ 
				"title" => "Glasser's Tools",
				"slug" => str_slug ( "Glasser's Tools" ) 
		],
		 [ 
				"title" => "Potter's Wheel",
				"slug" => str_slug ( "Potter's Wheel" ) 
		],
		 [ 
				"title" => "Maker's Mallet",
				"slug" => str_slug ( "Maker's Mallet" ) 
		],
		 [ 
				"title" => "Mortar and Pestle",
				"slug" => str_slug ( "Mortar and Pestle" ) 
		],
		 [ 
				"title" => "Chemistry Kit",
				"slug" => str_slug ( "Chemistry Kit" ) 
		],
		 [ 
				"title" => "Fishing Net",
				"slug" => str_slug ( "Fishing Net" ) 
		],
		 [ 
				"title" => "Shovel",
				"slug" => str_slug ( "Shovel" ) 
		],
		 [ 
				"title" => "Scraping Knife",
				"slug" => str_slug ( "Scraping Knife" ) 
		],
		 [ 
				"title" => "Oven",
				"slug" => str_slug ( "Oven" ) 
		],
		 [ 
				"title" => "Kettle",
				"slug" => str_slug ( "Kettle" ) 
		],
		 [ 
				"title" => "Tumbler",
				"slug" => str_slug ( "Tumbler" ) 
		],
		 [ 
				"title" => "Furnace",
				"slug" => str_slug ( "Furnace" ) 
		],
		 [ 
				"title" => "Prospector's Pick",
				"slug" => str_slug ( "Prospector's Pick" ) 
		],
		 [ 
				"title" => "Cutting Ruby",
				"slug" => str_slug ( "Cutting Ruby" ) 
		],
		 [ 
				"title" => "Cutting Diamond",
				"slug" => str_slug ( "Cutting Diamond" ) 
		],
		 [ 
				"title" => "Basin",
				"slug" => str_slug ( "Basin" ) 
		],
		 [ 
				"title" => "Superior Snips",
				"slug" => str_slug ( "Superior Snips" ) 
		],
		 [ 
				"title" => "Ring Rig",
				"slug" => str_slug ( "Ring Rig" ) 
		],
		 [ 
				"title" => "Armorer's Anvil",
				"slug" => str_slug ( "Armorer's Anvil" ) 
		],
		 [ 
				"title" => "Spit",
				"slug" => str_slug ( "Spit" ) 
		],
		 [ 
				"title" => "Dowsing Rod",
				"slug" => str_slug ( "Dowsing Rod" ) 
		],
		 [ 
				"title" => "Sugar Spile",
				"slug" => str_slug ( "Sugar Spile" ) 
		],
		 [ 
				"title" => "Melting Pot",
				"slug" => str_slug ( "Melting Pot" ) 
		]];
		$itemType = ItemType::where(["title"=>"Tool"])->first();
		foreach($tools as $index => $tool)
			try{
				$this->command->info ( "Creating Tool #".$index.", ".$tool["title"]."... success: ".Tool::firstOrCreate([
					"title"=>$tool["title"],
					"slug"=>$tool["slug"],
					"item_type_id"=>$itemType->id
				]));
			}
			catch(\ErrorException $ee){
				$this->command->error( $tool["title"].":  ".$ee->getMessage() ." at line ".$ee->getLine() );
			}
	}
}
