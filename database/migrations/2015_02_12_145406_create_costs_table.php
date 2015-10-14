<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCostsTable extends Migration {

	public function up()
	{
		Schema::create('costs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('value');
			$table->string('arithmetic_operator_id')->nullable()
				->foreign('arithmetic_operator_id')
				->references('id')->on('arithmetic_operators');
			$table->integer('character_class_id')->nullable()
				->foreign('character_class_id')
				->references('id')->on('character_classes');
			$table->integer('skill_id')
				->foreign('skill_id')
				->references('id')->on('skills');
			$table->integer('homeland_id')->nullable()
				->foreign('homeland_id')
				->references('id')->on('homelands');
			$table->integer('race_id')->nullable()
				->foreign('race_id')
				->references('id')->on('races');
		});
	}

	public function down()
	{
		Schema::drop('costs');
	}
}