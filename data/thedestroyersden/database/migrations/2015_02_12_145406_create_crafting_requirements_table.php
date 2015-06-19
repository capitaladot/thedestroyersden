<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCraftingRequirementsTable extends Migration {

	public function up()
	{
		Schema::create('crafting_requirements', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug');
			$table->integer('quantity');
		});
	}

	public function down()
	{
		Schema::drop('crafting_requirements');
	}
}