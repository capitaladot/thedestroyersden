<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisites', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer ( 'crafting_requirement_id' )->foreign ( 'crafting_requirement_id' )->references ( 'id' )->on ( 'crafting_requirements' );
			$table->integer('requisite_id');
			$table->string('requisite_type');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requisites');
    }
}
