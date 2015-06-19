<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleablesTable extends Migration {

	public function up()
	{
		Schema::create('saleables', function(Blueprint $table) {
			$table->integer('sale_id');
			$table->morphs('saleable');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('saleables');
	}
}