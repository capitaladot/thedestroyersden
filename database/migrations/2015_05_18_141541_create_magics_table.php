<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMagicsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'magics', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->string ( 'title' );
			$table->string ( 'slug' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'magics' );
	}
}
