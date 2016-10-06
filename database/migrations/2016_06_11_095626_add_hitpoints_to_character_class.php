<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHitpointsToCharacterClass extends Migration
{
    public function up()
    {
        Schema::table('character_classes', function (Blueprint $table)
        {
            $table->integer( 'hitpoints' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('character_classes', function (Blueprint $table)
        {
            $table->dropColumn("hitpoints");
        });
    }
}
