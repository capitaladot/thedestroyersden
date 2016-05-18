<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\RawResource;
use App\Craft;
use App\CraftingRequirement;
use App\ItemType;

class RawResourceTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 Gathered As	Commonality	Name	Price	Uses	Technique	Effect

	 */
	public function run()
	{
		$fromCSV = Excel::load(storage_path()."/app/Raw Resources.csv")->get();
		$itemType = ItemType::where('title','Raw Resource')->first();
		foreach($fromCSV as $index => $eachItemRow)
		{
			$eachItemRow->name = trim($eachItemRow->name);
			$this->command->info ( 'Creating raw resource #'.$index.':'.$eachItemRow->name);
			$eachItem{$index} = RawResource::create(['title'=>$eachItemRow->name]);
			$eachItemRow->name = trim($eachItemRow->name);
			foreach($eachItemRow as $columnIndex => $eachColumnValue){
				if(!empty($eachColumnValue)){
					$eachColumnValue = trim($eachColumnValue);
					$columnIndex = snake_case($columnIndex);
					switch($columnIndex){
						case 'technique':
							$technique = Craft::firstOrCreate(['title'=>$eachColumnValue]);
							$craftingRequirement = CraftingRequirement::create(['title'=>$eachItem{$index}->title .' - '. $eachColumnValue]);
							$craftingRequirement->crafts()->attach($technique->id);
							$craftingRequirement->rawResources()->save([$eachItem{$index}]);
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
							$eachItem{$index}->effect = $eachColumnValue;
							$eachItem{$index}->consumable = true;
						break;
					}
				}
			}
			$this->command->info ("... success: ".$eachItem{$index}->save());
		}
		$this->command->info ( 'Raw resources seeded!' );
	}
}