<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateToolsTable extends Migration {

	public function up()
	{
		Schema::create('tools', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->string('slug');
		});
	}

	public function down()
	{
		Schema::drop('tools');
	}
}