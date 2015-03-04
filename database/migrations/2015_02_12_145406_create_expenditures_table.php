<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpendituresTable extends Migration {

	public function up()
	{
		Schema::create('expenditures', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('player_character_id')
			->foreign('player_character_id')
			->references('id')->on('player_characters');
			$table->integer('cost_id')
			->foreign('cost_id')
			->references('id')->on('costs');
			$table->integer('skill_id')
			->foreign('skill_id')
			->references('id')->on('skills');
			$table->integer('arc_id')
			->foreign('arc_id')
			->references('id')->on('arcs');
		});
	}

	public function down()
	{
		Schema::drop('expenditures');
	}
}