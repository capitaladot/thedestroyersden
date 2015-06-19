<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArcsTable extends Migration {

	public function up()
	{
		Schema::create('arcs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('slug');
			$table->timestamp('start_time');
			$table->timestamp('end_time');
		});
	}

	public function down()
	{
		Schema::drop('arcs');
	}
}