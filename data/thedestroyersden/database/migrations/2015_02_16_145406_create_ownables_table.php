<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOwnablesTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'ownables', function (Blueprint $table) {
			$table->increments ( 'ownable_id' );
			$table->integer ( 'ownable_type' );
			$table->integer ( 'owner_id' );
			$table->timestamps ();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'ownables' );
	}
}
