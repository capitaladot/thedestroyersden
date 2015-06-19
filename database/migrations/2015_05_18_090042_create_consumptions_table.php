<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateConsumptionsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'consumptions', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'player_character_id' )->foreign ( 'player_character_id' )->references ( 'id' )->on ( 'player_characters' );
			$table->integer ( 'consumable_id' )->foreign ( 'consumable_id' )->references ( 'id' )->on ( 'consumables' );
			$table->timestamp ( 'consumed_at' )->nullable ();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'consumptions' );
	}
}
