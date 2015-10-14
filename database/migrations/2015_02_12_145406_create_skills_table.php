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
			//craft quantity produced
			$table->integer ( 'quantity' )->nullable();
			//craft quantity variable based on variable crafting requirement
			$table->integer ( 'variable' )->nullable();
			//parent skill
			$table->integer ( 'skill_id' )->nullable()->foreign ( 'skill_id' )->references ( 'id' )->on ( 'skills' );
		});
	}

	public function down()
	{
		Schema::drop('skills');
	}
}