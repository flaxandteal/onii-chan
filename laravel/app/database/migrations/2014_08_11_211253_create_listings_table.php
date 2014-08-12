<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->string('interested_in');
			$table->string('interested_in_categories');
			$table->string('experience');
			$table->string('technologies');
			$table->string('career_seekers');
			$table->string('seeking');
			$table->string('tags');
			$table->string('sections');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('listings');
	}

}
