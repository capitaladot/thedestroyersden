<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendablesTable extends Migration {

	public function up()
	{
		Schema::create('attendables', function(Blueprint $table) {
			$table->integer('arc_id');
			$table->morphs('attendable');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('attendables');
	}
}