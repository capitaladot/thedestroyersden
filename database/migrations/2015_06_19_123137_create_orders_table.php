<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//'approved','executed','failed','final_total','processor','reference_id'
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('approved')->default(false);
			$table->boolean('executed')->default(false);
			$table->boolean('failed')->default(false);
			$table->float('final_total');
			$table->string('processor')->nullable();
			$table->string('reference_id')->nullable();
			$table->integer('user_id')->unsigned()->nullable()->foreign('user_id')->references('id')->on('users');
			$table->integer('discount_id')->unsigned()->nullable()->foreign('discount_id')->references('id')->on('discounts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
