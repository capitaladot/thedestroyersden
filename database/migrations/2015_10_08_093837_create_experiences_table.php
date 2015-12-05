<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create ( 'experiences', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer('player_character_id')
				->foreign('player_character_id')
				->references('id')->on('player_characters');
			$table->integer('arc_id')
				->foreign('arc_id')
				->references('id')->on('arcs');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('experiences');
	}

}
