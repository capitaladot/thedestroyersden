<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddGraphIdToUsersTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table ( 'users', function (Blueprint $table) {
			$table->bigInteger ( 'graph_id' )->nullable ();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table ( 'users', function (Blueprint $table) {
			$table->removeColumn ( 'graph_id' );
		} );
	}
}
