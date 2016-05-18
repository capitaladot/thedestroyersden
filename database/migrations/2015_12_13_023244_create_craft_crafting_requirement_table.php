<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCraftCraftingRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create ( 'craft_crafting_requirement', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'craft_id' )->foreign ( 'craft_id' )->references ( 'id' )->on ( 'skills' );
			$table->integer ( 'crafting_requirement_id' )->foreign ( 'crafting_requirement_id' )->references ( 'id' )->on ( 'crafting_requirements' );
		} );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop ( 'craft_crafting_requirement' );
    }
}
