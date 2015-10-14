<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateItemsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'items', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->string ( 'title' );
			$table->string ( 'slug' );
			$table->text ( 'effect' )->nullable();
			$table->integer ( 'damage' )->nullable();
			$table->integer ( 'quantity' )->nullable();
			$table->string('arithmetic_operator_id')->nullable()
				->foreign('arithmetic_operator_id')
				->references('id')->on('arithmetic_operators');
			$table->text ( 'uses' )->nullable();
			$table->string('used_by')->nullable();
			$table->integer('price')->nullable();
			$table->boolean ( 'consumable' )->default ( false );
			$table->boolean ( 'rare' )->default ( false );
			$table->boolean ( 'variable' )->default ( false );
			$table->integer('item_type_id')
				->foreign('item_type_id')
				->references('id')->on('item_types');
			$table->integer('damage_type_id')->nullable()
				->foreign('damage_type_id')
				->references('id')->on('damage_types');
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'items' );
	}
}
