<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSpellsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'spells', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->string ( 'title' );
			$table->string ( 'slug' );
			$table->text ( 'description' );
			$table->integer ( 'magic_id' )->foreign ( 'magic_id' )->references ( 'id' )->on ( 'magics' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'spells' );
	}
}
