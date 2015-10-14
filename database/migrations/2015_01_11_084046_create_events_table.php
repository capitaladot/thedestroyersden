<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateEventsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		{
			Schema::create ( 'events', function (Blueprint $table) {
				$table->increments ( 'id' );
				$table->bigInteger ( 'facebook_id' )->unsigned ()->nullable ()->index ();
				$table->string ( 'name' );
				$table->timestamps ();
				$table->string ( 'slug' );
				$table->string ( 'title' );
				$table->datetime ( 'start_time' );
				$table->datetime ( 'end_time' )->nullable ();
				$table->string ( 'timezone' );
				$table->text ( 'description' );
				$table->integer ( 'owner_id' )->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' );
			} );
		}
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'events' );
	}
}
