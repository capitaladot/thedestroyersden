<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraftingOccurrencesConsumptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crafting_occurrences_consumptions', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crafting_occurrence_id');
            $table->unsignedInteger('consumption_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crafting_occurrences_consumptions');
    }
}
