<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->unsignedInteger('sort_order');
			$table->unsignedInteger('requirement_group_id')->references('id')->on('requirement_groups');
			//craft quantity produced
			$table->integer ( 'quantity' )->nullable();
			//craft quantity variable based on variable crafting requirement
			$table->integer ( 'variable' )->nullable();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requirements');
    }
}
