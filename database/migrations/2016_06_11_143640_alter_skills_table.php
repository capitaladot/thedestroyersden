<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSkillsTable extends Migration
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
            $table->renameColumn("quantity","max_purchases");
            $table->renameColumn("variable","level");
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
            $table->renameColumn("quantity","max_purchases");
            $table->renameColumn("level","variable");
        });
    }
}
