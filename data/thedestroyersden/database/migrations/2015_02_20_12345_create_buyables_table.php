<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuyablesTable extends Migration {

	public function up()
	{
		Schema::create('buyables', function(Blueprint $table) {
			$table->integer('buy_id');
			$table->morphs('buyable');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('buyables');
	}
}