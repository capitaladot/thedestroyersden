<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHomelandsTable extends Migration {

	public function up()
	{
		Schema::create('homelands', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('homelands');
	}
}