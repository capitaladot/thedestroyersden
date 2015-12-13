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
		//nav
		$this->call('MenuTableSeeder');
		$this->call('MenuItemTableSeeder');
		$this->call('LinkTableSeeder');
		//site
		$this->call('RoleTableSeeder');
		$this->call('PermissionTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PermissionUserTableSeeder');
		$this->call('PermissionRoleTableSeeder');
		$this->call('PasswordResetsTableSeeder');
		//game
		$this->call('ArithmeticOperatorTableSeeder');
		$this->call('DamageTypeTableSeeder');
		$this->call('ItemTypeTableSeeder');
		$this->call('CharacterClassTableSeeder');
		$this->call('HomelandTableSeeder');
		$this->call('RaceTableSeeder');
		$this->call('SkillTableSeeder');
		$this->call('PrerequisiteTableSeeder');
		$this->call('CostTableSeeder');
		$this->call('SlotTableSeeder');
		$this->call('SpellTableSeeder');
		$this->call('ArcTableSeeder');
/*
		
		$this->call('WeaponTableSeeder');*/
		$this->call('RawResourceTableSeeder');
		$this->call('CraftingComponentTableSeeder');
		//$this->call('CraftingRequirementTableSeeder');
		$this->call('FinalProductTableSeeder');
		$this->call('ToolTableSeeder');
		$this->call('CraftTableSeeder');
		$this->call('SaleTableSeeder');
		//lastish
		$this->call('PlayerCharacterTableSeeder');
		//laster
		$this->call('ExperienceTableSeeder');
		$this->call('CraftingOccurrenceTableSeeder');
		$this->call('ExpenditureTableSeeder');
		
		
	}

}
