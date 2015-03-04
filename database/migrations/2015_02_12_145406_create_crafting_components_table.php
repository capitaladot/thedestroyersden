<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCraftingComponentsTable extends Migration {

	public function up()
	{
		Schema::create('crafting_components', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('slug');
			$table->double('value')->nullable()->default(null);
			$table->timestamp('consumed_at')
				->nullable(true)
				->default(null);
			$table->integer('consumed_by')
				->nullable(true)
				->default(null)
				->foreign('player_character_id')
				->references('id')
				->on('player_characters');
		});
	}

	public function down()
	{
		Schema::drop('crafting_components');
	}
}