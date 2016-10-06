<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirables', function(Blueprint $table)
        {
            $table->timestamps();
            $table->unsignedInteger('requirement_id')->references('id')->on('requirements');
            $table->morphs('requirer');
            $table->morphs('requirable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requirables');
    }
}
