<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmazonIdToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table ( 'users', function (Blueprint $table) {
			$table->bigInteger ( 'amazon_id' )->nullable ();
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table ( 'users', function (Blueprint $table) {
			$table->removeColumn ( 'amazon_id' );
		} );
	}
}
