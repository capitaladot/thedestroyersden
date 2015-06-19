<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggablesTable extends Migration {

	public function up()
	{
		Schema::create('taggables', function(Blueprint $table) {
			$table->increments('id');
			$table->morphs('taggable');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('taggables');
	}
}