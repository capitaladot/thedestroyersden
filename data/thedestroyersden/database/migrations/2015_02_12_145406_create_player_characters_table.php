<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerCharactersTable extends Migration {

	public function up()
	{
		Schema::create('player_characters', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug');
			$table->integer('user_id')
				->foreign('user_id')
				->references('id')->on('users');
			$table->integer('character_class_id')
				->foreign('character_class_id')
				->references('id')->on('character_classes');
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
		Schema::drop('player_characters');
	}
}