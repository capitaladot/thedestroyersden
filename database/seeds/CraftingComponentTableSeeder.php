<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\CraftingComponent;
use App\Craft;
use App\CraftingRequirement;

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
		foreach($fromCSV as $index => $eachItemRow){
			Model::unguard();
			$eachItem{$index} = CraftingComponent::create(['title'=>$eachItemRow->name]);
			foreach($eachItemRow as $columnIndex => $eachColumnValue){
				if(!empty($eachColumnValue)){
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