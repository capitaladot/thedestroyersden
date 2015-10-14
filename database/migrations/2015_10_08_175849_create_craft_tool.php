<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCraftTool extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'craft_tool', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'craft_id' )->foreign ( 'craft_id' )->references ( 'id' )->on ( 'skills' );
			$table->integer ( 'tool_id' )->foreign ( 'tool_id' )->references ( 'id' )->on ( 'items' );
		} );
	}
	public function down() {
		Schema::drop ( 'craft_tool' );
	}

}
