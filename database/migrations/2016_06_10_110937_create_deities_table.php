<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeitiesTable extends Migration{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create ( 'deities', function (Blueprint $table) {
            $table->increments ( 'id' );
            $table->timestamps ();
            $table->string ( 'title' );
            $table->string ( 'slug' );
            $table->string ( 'clerical_title' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop ( 'deities' );
    }
}
