<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_types', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('model_class');
        });
    }

    public function down()
    {
        Schema::drop('skill_types');
    }
}
