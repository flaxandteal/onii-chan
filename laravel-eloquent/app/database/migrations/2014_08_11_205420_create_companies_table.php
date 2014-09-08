<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('listing_id')->nullable();
			$table->string('name');
			$table->integer('type_id');
			$table->string('website');
			$table->integer('endorsements');
			$table->string('location');
			$table->string('size')->nullable();
			$table->string('founded')->nullable();
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
		Schema::drop('companies');
	}

}
