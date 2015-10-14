<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//items produced by a craft
class CreateCraftItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'craft_item', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'craft_id' )->foreign ( 'craft_id' )->references ( 'id' )->on ( 'skills' );
			$table->integer ( 'item_id' )->foreign ( 'item_id' )->references ( 'id' )->on ( 'items' );
		} );
	}
	public function down() {
		Schema::drop ( 'craft_item' );
	}

}
