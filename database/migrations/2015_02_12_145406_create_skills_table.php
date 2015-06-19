<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillsTable extends Migration {

	public function up()
	{
		Schema::create('skills', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string ( 'title' );
			$table->string('slug');
			$table->text('description');
		});
	}

	public function down()
	{
		Schema::drop('skills');
	}
}