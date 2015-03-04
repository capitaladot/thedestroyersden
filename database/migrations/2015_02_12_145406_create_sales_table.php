<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesTable extends Migration {

	public function up()
	{
		Schema::create('sales', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->morphs('buyable');
			$table->morphs('saleable');
			$table->integer('arc_id')
				->foreign('arc_id')
				->references('id')->on('arcs');
		});
	}

	public function down()
	{
		Schema::drop('sales');
	}
}