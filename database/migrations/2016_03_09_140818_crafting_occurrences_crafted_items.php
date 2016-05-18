<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraftingOccurrencesCraftedItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crafting_occurrences_crafted_items', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crafting_occurrence_id');
            $table->unsignedInteger('item_id');
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
        //
    }
}
