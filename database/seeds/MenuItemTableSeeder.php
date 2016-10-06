<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use MartinBean\MenuBuilder\MenuItem;
use App\MainMenu;

class MenuItemTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach([
			'Arc','ArithmeticOperator','CharacterClass','Consumable','Consumption','Cost',
			'CraftingComponent','CraftingOccurrence','CraftingRequirement',//'CraftingRequirementAlternative',
			'DamageType','Description','Discount','Durable','Economy','Event','Expenditure','Experience',
			'Homeland','Item','ItemType','Link','Meal',			'Order','Ownable','PlayerCharacter','Prerequisite','Processor','Race','RawResource','Rule','Sale','Skill','Spell','Tag','Ticket','Tool','User','Weapon'
		] as $model){
			$model = "App\\".$model;
			$this->command->info("Making menu items for: ".$model);
			if($model::implementsInterface(\MartinBean\MenuBuilder\Contracts\NavigatableContract::class)) {
				foreach ($model::all() as $eachInstance) {
					if (is_null($eachInstance)) {
						$this->command->error("Model instance of " . $model . " was false?");
						continue;
					}
					else
						$this->command->info("Model #".$eachInstance->id." instance of " . $model );
					if ($eachInstance::implementsInterface(\MartinBean\MenuBuilder\Contracts\NavigatableContract::class)
						&&
					!$eachInstance::isNavigable($eachInstance)) {
						if ($model::hasTrait("App\Traits\Navigatable"))
							$model::fixNavigability($eachInstance);
						$eachInstance = $eachInstance::provideNavigatable($eachInstance);
						if($eachInstance) {
							$this->command->info('Created menu item for:'
								. $eachInstance->getTitle()
								. "... success:" . $eachInstance->isNavigable($eachInstance)
							);
						}
					}
				}
			}
			else {
				$this->command->error($model . " was not Navigatable nor RoutedById.");
				$this->command->error(collect(class_uses ($model,false)));
			}
		}
		$this->command->info ( 'Menu Item table seeded!' );
	}
}
