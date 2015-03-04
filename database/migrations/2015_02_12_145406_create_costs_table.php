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
			$table->integer('character_class_id')
				->foreign('character_class_id')
				->references('id')->on('character_classes');
			$table->integer('skill_id')
				->foreign('skill_id')
				->references('id')->on('skills');
			$table->integer('homeland_id')
				->foreign('homeland_id')
				->references('id')->on('homelands');
			$table->integer('race_id')
				->foreign('race_id')
				->references('id')->on('races');
		});
	}

	public function down()
	{
		Schema::drop('costs');
	}
}