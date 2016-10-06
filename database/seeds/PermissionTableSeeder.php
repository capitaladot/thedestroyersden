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
			'CraftingComponent','CraftingOccurrence','Requirement','CraftingRequirementAlternative',
			'DamageType','Description','Discount','Durable','Economy','Event','Expenditure','Experience',
			'FinalProduct','Homeland','Item','ItemType','Link','MainMenu','MainMenuItem',
			'Order','Ownable','PlayerCharacter','Prerequisite','Race','RawResource','Requirement','Rule','Sale','Skill',
			'Spell','Tag','Ticket','Tool','User','Weapon'
		] as $model){
			foreach($permissionTypes as $permissionType){
				$permissions[] = 
					[
						'name' => $permissionType.'.'.str_slug($model),
						'slug' => $permissionType.'.'.str_slug($model),
						'description' => NULL,
						'model' => 'App\\'.$model
					];
			}
		}
		\DB::table('permissions')->insert($permissions);
	}

}
