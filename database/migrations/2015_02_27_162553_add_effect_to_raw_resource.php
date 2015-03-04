<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEffectToRawResource extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('raw_resources', function(Blueprint $table)
		{
			$table->string('effect')->nullable();
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
			$table->removeColumn('effect');
		});
	}

}
