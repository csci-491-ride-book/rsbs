<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRidePostingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ride_postings', function(Blueprint $table) {
            $table->increments('id');
			$table->string('to');
			$table->string('from');
			$table->string('date');
			$table->integer('user_id');
			$table->integer('seats');
			$table->string('price');
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
	    Schema::drop('ride_postings');
	}

}
