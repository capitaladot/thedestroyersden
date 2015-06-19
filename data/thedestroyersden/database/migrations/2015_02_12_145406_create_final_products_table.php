<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFinalProductsTable extends Migration {

	public function up()
	{
		Schema::create('final_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug');
			$table->morphs('ownable');
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
		Schema::drop('final_products');
	}
}