<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarvestResourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create ( 'harvest_resource', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'craft_id' )->foreign ( 'craft_id' )->references ( 'id' )->on ( 'skills' );
			$table->integer ( 'raw_resource_id' )->foreign ( 'raw_resource_id' )->references ( 'id' )->on ( 'items' );
		} );
	}
	public function down() {
		Schema::drop ( 'harvest_resource' );
	}

}
