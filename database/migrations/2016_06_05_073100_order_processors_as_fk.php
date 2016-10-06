<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderProcessorsAsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table)
        {
            $table->dropColumn("processor");
            $table->unsignedInteger( 'processor_id' )->foreign ( 'processor_id' )->references ( 'id' )->on ( 'processors' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table)
        {
            $table->dropColumn("processor_id");
            $table->string ( 'processor' );
        });
    }
}
