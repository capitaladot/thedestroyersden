<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permissions')->delete();
        $permissions = [];
		$permissionTypes = ['create','delete','edit','list','read'];
		foreach([
			'Advantage','Arc','ArithmeticOperator','CharacterClass','Consumable','Consumption','Cost',
			'CraftingComponent','CraftingOccurrence','CraftingRequirement','CraftingRequirementAlternative',
			'DamageType','Description','Discount','Durable','Economy','Event','Expenditure','Experience',
			'FinalProduct','Homeland','Item','ItemType','Link','MainMenu','MainMenuItem','Memorization',
			'Order','Ownable','PlayerCharacter','Prerequisite','Race','RawResource','Sale','Skill','Slot',
			'Spell','Tag','Ticket','Tool','User','Weapon'
		] as $model){
			foreach($permissionTypes as $permissionType){
				$permissions[] = 
					[
						'name' => $permissionType.'.'.str_slug($model).'s',
						'slug' => $permissionType.'.'.str_slug($model).'s',
						'description' => NULL,
						'model' => 'App\\'.$model
					];
			}
		}
		\DB::table('permissions')->insert($permissions);
	}

}
