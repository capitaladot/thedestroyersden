<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
		Schema::create ( 'descriptions', function (Blueprint $table) {
        $table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('slug');
			$table->string('body');
			$table->morphs('describable');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop ( 'descriptions' );
    }
}
