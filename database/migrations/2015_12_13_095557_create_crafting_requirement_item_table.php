<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCraftingRequirementItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'crafting_requirement_item', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->integer ( 'crafting_requirement_id' )->foreign ( 'crafting_requirement_id' )->references ( 'id' )->on ( 'crafting_requirements' );
			$table->integer ( 'item_id' )->foreign ( 'item_id' )->references ( 'id' )->on ( 'items' );
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop ( 'crafting_requirement_item' );
    }
}
