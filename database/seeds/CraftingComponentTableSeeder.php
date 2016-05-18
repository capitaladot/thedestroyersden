<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CraftingComponent;
use App\Craft;
use App\CraftingRequirement;
use App\ItemType;
use App\Requisite;

class CraftingComponentTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 Gathered As	Commonality	Name	Price	Uses	Technique	Effect

	 */
	public function run()
	{
		$fromCSV = Excel::load(storage_path()."/app/Crafted Components.csv")->get();
		$itemType = ItemType::where('title','Crafting Component')->first();
		foreach($fromCSV as $index => $eachItemRow){
			Model::unguard();
			$eachItemRow->name = trim($eachItemRow->name);
			$eachItem{$index} = CraftingComponent::create(['title'=>trim($eachItemRow->name),'item_type_id'=>$itemType->id]);
			foreach($eachItemRow as $columnIndex => $eachColumnValue){
				if(!empty($eachColumnValue)){
					$eachColumnValue = trim($eachColumnValue);
					switch($columnIndex){
						case 'technique':
							$technique = Craft::firstOrCreate(['title'=>$eachColumnValue]);
							$craftingRequirement = CraftingRequirement::create(['title'=>$eachItem{$index}->title .' - '. $eachColumnValue]);
							$craftingRequirement->crafts()->attach($technique->id);
							$craftingRequirement->items()->attach($eachItem{$index}->id);
							$requisite = new Requisite;
							$requisite->requisite_type = get_class($eachItem{$index});
							$requisite->requisite_id = $eachItem{$index}->id;
							$requisite->crafting_requirement_id = $craftingRequirement->id;
							$requisite->save();
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
						case 'effect':
							$eachItem{$index}->consumable = true;
						break;
					}
				}
			}
			$this->command->info ( "Creating crafting component#".$index.", ".$eachItem{$index}->title."... success: ".$eachItem{$index}->save());
		}
		$this->command->info ( 'Crafting components seeded!' );
	}
}