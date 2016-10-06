<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManapoolToCharacterClasses extends Migration
{
    public function up()
    {
        Schema::table('character_classes', function (Blueprint $table)
        {
            $table->integer( 'manapool' );
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
            $table->dropColumn("manapool");
        });
    }
}
