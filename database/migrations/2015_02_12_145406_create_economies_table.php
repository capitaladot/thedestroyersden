<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEconomiesTable extends Migration {

	public function up()
	{
		Schema::create('economies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->double('buy_factor');
			$table->double('sell_factor');
			$table->string('title');
			$table->string('slug');
			$table->integer('arc_id')
				->foreign('arc_id')
				->references('id')->on('arcs');
		});
	}

	public function down()
	{
		Schema::drop('economies');
	}
}