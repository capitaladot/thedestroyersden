<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrerequisitesTable extends Migration {

	public function up()
	{
		Schema::create('prerequisites', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('slug');
			$table->integer('skill_id')
				->foreign('skill_id')
				->references('id');
		});
	}

	public function down()
	{
		Schema::drop('prerequisites');
	}
}