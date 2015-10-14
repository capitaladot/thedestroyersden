<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('ArithmeticOperatorTableSeeder');
		$this->call('RoleTableSeeder');
		$this->call('LinkTableSeeder');
		$this->call('DamageTypeTableSeeder');
		$this->call('ItemTypeTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('CharacterClassTableSeeder');
		$this->call('HomelandTableSeeder');
		$this->call('RaceTableSeeder');
		$this->call('SkillTableSeeder');
		$this->call('CraftTableSeeder');
		$this->call('PrerequisiteTableSeeder');
		$this->call('CostTableSeeder');
		$this->call('SlotTableSeeder');
		$this->call('SpellTableSeeder');
		$this->call('ArcTableSeeder');
/*
		$this->call('ToolTableSeeder');
		$this->call('WeaponTableSeeder');
		$this->call('RawResourceTableSeeder');
		$this->call('CraftingComponentTableSeeder');
		$this->call('CraftingRequirementTableSeeder');
*/
		$this->call('FinalProductTableSeeder');
		$this->call('SaleTableSeeder');
		//lastish
		$this->call('PlayerCharacterTableSeeder');
		//laster
		$this->call('ExperienceTableSeeder');
		$this->call('CraftingOccurrenceTableSeeder');
		$this->call('ExpenditureTableSeeder');
		$this->call('PermissionTableSeeder');
		$this->call('PermissionRoleTableSeeder');
		$this->call('PermissionUserTableSeeder');
		$this->call('PasswordResetsTableSeeder');
		$this->call('ExpenditureTableSeeder');
		$this->call('MenuTableSeeder');
		$this->call('MenuItemTableSeeder');
	}

}
