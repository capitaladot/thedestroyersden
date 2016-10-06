<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: austi_000
 * Date: 6/11/2016
 * Time: 12:55 PM
 */
class RulesAndSkillsSeeder extends Seeder
{ /**
 * Run the database seeds.
 *
 * @return void
 */
	public function run()
	{
		$this->call('App\Database\Seeds\RuleTableSeeder');
		$this->call('App\Database\Seeds\ItemRuleTableSeeder');
		$this->call('App\Database\Seeds\SkillTableSeeder');
	}
}
