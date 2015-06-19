<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCraftingOccurrencesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'crafting_occurrences', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->morphs ( 'craftable' );
			$table->integer ( 'creator_id' )->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'crafting_occurrences' );
	}
}
