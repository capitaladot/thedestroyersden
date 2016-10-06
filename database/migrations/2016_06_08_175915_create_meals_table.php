<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->datetime('redeemed_at');
            $table->integer('order_id')->unsigned()->foreign('order_id')->references('id')->on('orders');
            $table->integer('meal_type_id')->unsigned()->foreign('meal_type_id')->references('id')->on('meal_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meals');
    }

}
