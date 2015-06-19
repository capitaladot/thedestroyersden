<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMemorizationsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'memorizations', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->timestamps ();
			$table->string ( 'title' );
			$table->string ( 'slug' );
			$table->integer ( 'expenditure_id' )->foreign ( 'expenditure_id' )->references ( 'id' )->on ( 'expenditures' );
			$table->integer ( 'spell_id' )->foreign ( 'spell_id' )->references ( 'id' )->on ( 'spells' );
			$table->integer ( 'arc_id' )->foreign ( 'arc_id' )->references ( 'id' )->on ( 'arcs' );
		} );
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'memorizations' );
	}
}
