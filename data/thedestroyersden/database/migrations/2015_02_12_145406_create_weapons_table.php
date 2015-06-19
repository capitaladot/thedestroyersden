<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeaponsTable extends Migration {

	public function up()
	{
		Schema::create('weapons', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('weapons');
	}
}