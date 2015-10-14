<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\ArithmeticOperator;
use App\Craft;
use App\CraftingComponent;
use App\CraftingRequirement;
use App\CraftingRequirementAlternative;
use App\DamageType;
use App\Item;
use App\ItemType;
use App\Skill;

class CraftTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 Gathered As	Commonality	Name	Price	Uses	Technique	Effect

	 */
	protected function createItem($title,$parentCraftObject,$spreadsheetRow,$quantity="",$variable=false){
		//$this->command->info(s($spreadsheetRow));
		$itemYield = Item::firstOrCreate([
			'title'=>$title,
			'item_type_id'=>$this->itemTypes[trim($spreadsheetRow->category)]->id
		]);
		if(!empty($quantity))
			$itemYield->quantity = $quantity;
		if($variable)
			$itemYield->variable = true;
		switch($spreadsheetRow->category){								
			case 'Consumable':
			case 'Crafting Component':
			case 'Rune':
				$itemYield->consumable = true;
			break;
		}
		$itemYield->effect = $spreadsheetRow->effect;
		if(!empty($spreadsheetRow->damage_operator)){
			$itemYield->arithmetic_operator_id = $this->arithmeticOperators[trim($spreadsheetRow->damage_operator)]->id;
		}
		if(!empty($spreadsheetRow->damage_type))
			$itemYield->damage_type_id = $this->damageTypes[trim(ucfirst(strtolower($spreadsheetRow->damage_type)))]->id;
		if(!empty($spreadsheetRow->damage))
			$itemYield->damage = $spreadsheetRow->damage;
		$this->command->info("Saved item: ".$itemYield->title ." ? ". $itemYield->save());
		$itemYield->crafts()->attach($parentCraftObject->id);
	}
	public function run()
	{
		$fromCSV = Excel::load(storage_path()."/app/Crafting Techniques - Sheet1.tsv")->get();
		$this->itemTypes = [];
		foreach(ItemType::all() as $eachItemType){
			$this->itemTypes[trim($eachItemType->title)] = $eachItemType;
			$this->command->info('Loaded itemType: '.$eachItemType->title);
		}
		$this->damageTypes = [];
		foreach(DamageType::all() as $eachDamageType){
			$this->damageTypes[trim($eachDamageType->title)] = $eachDamageType;
			$this->command->info('Loaded damageType: '.$eachDamageType->title);
		}
		$this->arithmeticOperators = [];
		foreach(ArithmeticOperator::all() as $eachArithmeticOperator){
			$this->arithmeticOperators[trim($eachArithmeticOperator->title)] = $eachArithmeticOperator;
			$this->command->info('Loaded arithmeticOperator: '.$eachArithmeticOperator->title);
		}
		foreach($fromCSV as $index => $eachCraftRow){
			$parentCraft{$index} = Craft::firstOrCreate(['title'=>$eachCraftRow->craft]);
			$parentCraft{$index}->skill()->associate(Skill::where(['title'=>'Crafter'])->firstOrFail())->save();
			$eachCraft = Craft::firstOrCreate(['title'=>$eachCraftRow->name,'skill_id'=>$parentCraft{$index}->id]);
			$craftingRequirements{$index} = [];
			foreach($eachCraftRow as $columnIndex => $eachColumnValue){
				if(!empty($eachColumnValue)){
					//$this->command->info($eachCraftRow->craft.": ".$eachCraftRow->name ." column: ".$columnIndex);
					switch($columnIndex){
						case 'yields':
							$yields = preg_split("/(, )|( or )|([0-9N]{1,2} )/",$eachColumnValue,15,PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
							//$this->command->info(s($yields));
							if(count($yields) == 1){
								$this->createItem($yields[0],$eachCraft,$eachCraftRow);
							}
							else{
								for($y=0; $y<count($yields); ++$y){
									$eachYield = trim($yields[$y]);
									if(in_array($eachYield,['or',','])){
										continue;
									}
									elseif($eachYield == 'N'){
										$this->createItem(trim($yields[$y+1]),$eachCraft,$eachCraftRow,false,true);
										++$y;//skip the next.
									}
									elseif(is_numeric($eachYield)){
										$this->createItem(trim($yields[$y+1]),$eachCraft,$eachCraftRow,$eachYield);
										++$y;//skip the next.
									}
									else{
										$this->createItem($eachYield,$eachCraft,$eachCraftRow);
									}
								}
							}
						break;
						case 'requirements':
							$requirements{$index} = preg_split("/, /",$eachColumnValue);
							foreach($requirements{$index} as $eachRequirement){
								$splitRequirementsByOr = explode(" or ",$eachRequirement);
								if(count($splitRequirementsByOr) > 1){
									$craftingRequirementAlternative = CraftingRequirementAlternative::create(['craft_id'=>$eachCraft->id]);
									foreach($splitRequirementsByOr as $eachSplitRequirementByOr){
										$eachSplitRequirementByOr = preg_split("/([0-9N]{1,2}) /",$eachSplitRequirementByOr,1,PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
										if(count($eachSplitRequirementByOr) > 1){
											if($eachSplitRequirementByOr[0] == 'N'){
												$craftingRequirements{$index}[] = CraftingRequirement::firstOrCreate([
													'title'=>$eachSplitRequirementByOr[1],
													'variable'=>true,
													'crafting_requirement_alternative_id'=>$craftingRequirementAlternative->id,
													'craft_id'=>$eachCraft->id
												]);
											}
											else{
												$craftingRequirements{$index}[] = CraftingRequirement::firstOrCreate([
													'title'=>$eachSplitRequirementByOr[1],
													'quantity'=>$eachSplitRequirementByOr[0],
													'crafting_requirement_alternative_id'=>$craftingRequirementAlternative->id,
													'craft_id'=>$eachCraft->id
												]);
											}
										}
										else{
											$craftingRequirements{$index}[] = CraftingRequirement::firstOrCreate([
												'title'=>$eachSplitRequirementByOr[0],
												'quantity'=> 1,
												'crafting_requirement_alternative_id'=>$craftingRequirementAlternative->id,
												'craft_id'=>$eachCraft->id
											]);
										}
									}
								}
								else{
									$eachRequirement = preg_split("/([0-9]{1,2}) /",$eachRequirement,1,PREG_SPLIT_DELIM_CAPTURE);
									$craftingRequirements{$index}[] = CraftingRequirement::firstOrCreate([
										'title'=>count($eachRequirement) > 1 ? $eachRequirement[1] : $eachRequirement[0],
										'quantity'=>count($eachRequirement) > 1 ? $eachRequirement[0] : 1,
										'craft_id'=>$eachCraft->id
									]);
								}
							}
						break;
					}
				}
			}
			//$craftingRequirements{$index}
			$this->command->info ( "Creating craft #".$index.", ".$eachCraft->title."... success: ".$eachCraft->save());
		}
		$this->command->info ( 'Crafts seeded!' );
	}
}