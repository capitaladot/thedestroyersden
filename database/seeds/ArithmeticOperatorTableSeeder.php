<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\ArithmeticOperator;

class ArithmeticOperatorTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$arithmetic_operators = [
			['title' =>'plus', 'value'=>'+','slug'=>str_slug('plus'),'id'=>1],
			['title' =>'minus', 'value'=>'-','slug'=>str_slug('minus'),'id'=>2],
			['title' =>'times', 'value'=>'*','slug'=>str_slug('times'),'id'=>3],
			['title' =>'divided by','value'=>'/', 'slug'=>str_slug('divided by'),'id'=>4]
		];
		foreach($arithmetic_operators as $arithmetic_operator)
		{
			$this->command->info ( 'Creating arithmetic operator:'.$arithmetic_operator['title']. "... success: ".ArithmeticOperator::create($arithmetic_operator));
		}
		$this->command->info ( 'Created arithemtic operators.');
	}

}
