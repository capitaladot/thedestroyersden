<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;

class PermissionRoleTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permission_role')->delete();
        $permissionRoles = [];
		$permissionTypes = ['create','delete','edit','list','read'];
		$roles = ['admin','user','guest'];
		foreach([
			'Advantage','Arc','ArithmeticOperator','CharacterClass','Consumable','Consumption','Cost',
			'CraftingComponent','CraftingOccurrence','CraftingRequirement','CraftingRequirementAlternative',
			'DamageType','Description','Discount','Durable','Economy','Event','Expenditure','Experience',
			'FinalProduct','Homeland','Item','ItemType','Link','MainMenu','MainMenuItem','Memorization',
			'Order','Ownable','PlayerCharacter','Prerequisite','Race','RawResource','Sale','Skill','Slot',
			'Spell','Tag','Ticket','Tool','User','Weapon'
		] as $model){
			foreach($permissionTypes as $permissionType){
				foreach($roles as $role)
					switch($role){
						case 'admin':
							$permissionRoles[] = [
									'role_id' => Role::where('name','=',$role)->first()->id,
									'permission_id' => Permission::where('slug','=',$permissionType.'.'.str_slug($model).'s')->first()->id
								];					
						break;
						case 'user';
							if(in_array($permissionType,['read']))
								$permissionRoles[] = [
									'role_id' => Role::where('name','=',$role)->first()->id,
									'permission_id' => Permission::where('slug','=',$permissionType.'.'.str_slug($model).'s')->first()->id
								];
							elseif(in_array($permissionType,['create','edit']) && in_array($model,['Order','Expenditure','PlayerCharacter']))
								$permissionRoles[] = [
									'role_id' => Role::where('name','=',$role)->first()->id,
									'permission_id' => Permission::where('slug','=',$permissionType.'.'.str_slug($model).'s')->first()->id
								];
						break;
						case 'guest';
							if(in_array($permissionType,['read']) && (in_array($model,['User']) && $permissionType =='create'))
								$permissionRoles[] = [
									'role_id' => Role::where('name','=',$role)->first()->id,
									'permission_id' => Permission::where('slug','=',$permissionType.'.'.str_slug($model).'s')->first()->id
								];
						break;
					}
			}
		}
		\DB::table('permission_role')->insert($permissionRoles);
	}

}
