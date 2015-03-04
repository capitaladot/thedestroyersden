<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsumableToRawResource extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('raw_resources', function(Blueprint $table)
		{
			$table->boolean('consumable')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('raw_resources', function(Blueprint $table)
		{
			$table->removeColumn('consumable');
		});
	}

}
