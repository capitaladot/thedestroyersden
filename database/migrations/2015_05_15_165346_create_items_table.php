<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateItemsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'items', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->string ( 'title' );
			$table->string ( 'slug' );
			$table->boolean ( 'consumable' )->default ( false );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'items' );
	}
}
