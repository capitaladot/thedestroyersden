<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_groups', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('conjunction')->default('or');
        });
    }

    public function down()
    {
        Schema::drop('requirement_groups');
    }
}
