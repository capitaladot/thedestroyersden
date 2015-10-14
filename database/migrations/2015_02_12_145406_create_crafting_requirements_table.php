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
			$table->boolean('variable')->default(false);
			$table
			->integer ( 'crafting_requirement_alternative_id' )
			->nullable()
			->foreign ( 'crafting_requirement_alternative_id' )
			->references ( 'id' )->on ( 'crafting_requirement_alternatives' );
			$table->integer ( 'craft_id' )->foreign ( 'craft_id' )->references ( 'id' )->on ( 'skills' );
		});
	}

	public function down()
	{
		Schema::drop('crafting_requirements');
	}
}