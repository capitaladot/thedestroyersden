<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSkillTypeIdToSkill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skills', function (Blueprint $table)
        {
            $table->unsignedInteger("skill_type_id")
                ->references('id')->on('skill_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */ 
    public function down()
    {
        Schema::table('skills', function (Blueprint $table)
        {
            $table->dropColumn("skill_type_id");
        });
    }
}
