<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharacterClassesTable extends Migration {

	public function up()
	{
		Schema::create('character_classes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('character_classes');
	}
}