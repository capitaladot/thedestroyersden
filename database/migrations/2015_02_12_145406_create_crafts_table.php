<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCraftsTable extends Migration {

	public function up()
	{
		Schema::create('crafts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug');
			$table->integer('skill_id')
				->foreign('skill_id')
				->references('id')->on('skills');
		});
	}

	public function down()
	{
		Schema::drop('crafts');
	}
}