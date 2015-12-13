<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Weapon;
use App\Consumable;
use App\Craft;
use App\CraftingRequirement;
use App\ItemType;
use App\Item;

class FinalProductTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$fromCSV = Excel::load(storage_path()."/app/Perfected Products.csv")->get();
		foreach($fromCSV as $index => $eachItemRow){
			Model::unguard();
			$eachItemRow->name = trim($eachItemRow->name);
			if(!empty($eachItemRow->effect)){
				if(stristr($eachItemRow->effect,' Damage') !== FALSE){
					$eachItem{$index} = Weapon::create(['title'=>$eachItemRow->name]);
					$eachItem{$index}->damage = pos(explode(" ",$eachItemRow->effect));
					$eachItem{$index}->itemType()->associate(ItemType::where(['title'=>'Weapon'])->first());
				}
				else{
					$eachItem{$index} = Consumable::create(['title'=>$eachItemRow->name]);
					$eachItem{$index}->itemType()->associate(ItemType::where(['title'=>'Consumable'])->first());
					$eachItem{$index}->consumable = true;
					$eachItem{$index}->effect = $eachItemRow->effect;
				}
			}
			else if(!empty($eachItemRow->Uses)){
				$eachItem{$index} = Tool::create(['title'=>$eachItemRow->name]);
				$eachItem{$index}->itemType->associate(ItemType::where('title','Container')->first());
			}
			else{
				$eachItem{$index} = Item::create(['title'=>$eachItemRow->name]);
			}
			foreach($eachItemRow as $columnIndex => $eachColumnValue){
				if(!empty($eachColumnValue)){
					$eachColumnValue = trim($eachColumnValue);
					switch($columnIndex){
						case 'technique':
							$technique = Craft::firstOrCreate(['title'=>$eachColumnValue]);
							$technique->items()->attach($eachItem{$index}->id);
						break;
						case 'gathered_as':
							$harvest = Craft::firstOrCreate(['title'=>$eachColumnValue]);
							$eachItem{$index}->harvestingTechniques()->attach($harvest);
						break;
						case 'commonality':
							if($eachColumnValue == 'Rare')
								$eachItem{$index}->rare = true;
						break;
						case 'price':
							//garbage data from fixed price items
							$eachItem{$index}->price = $eachColumnValue;
						break;
						case 'uses':
							$eachItem{$index}->uses = $eachColumnValue;
						break;
					}
				}
			}
			$this->command->info ( 'Creating final product#'.$index.': '.$eachItem{$index}->title. "... success: ".$eachItem{$index}->save());
		}
		$this->command->info ( 'Final products seeded!' );
	}
}
