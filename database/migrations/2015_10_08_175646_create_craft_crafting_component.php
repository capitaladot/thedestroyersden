<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCraftCraftingComponent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'craft_crafting_component', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'craft_id' )->foreign ( 'craft_id' )->references ( 'id' )->on ( 'skills' );
			$table->integer ( 'crafting_component_id' )->foreign ( 'crafting_component_id' )->references ( 'id' )->on ( 'items' );
		} );
	}
	public function down() {
		Schema::drop ( 'craft_crafting_component' );
	}

}
