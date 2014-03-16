<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRequestsTableToRideRequests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('requests');

		Schema::create('ride_requests', function(Blueprint $table) {
            $table->increments('id');
			$table->boolean('status');
			$table->integer('posting_id');
			$table->integer ('user_id');
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
		Schema::drop('ride_requests');

		Schema::create('requests', function(Blueprint $table) {
            $table->increments('id');
			$table->boolean('status');
			$table->integer('posting_id');
			$table->integer ('user_id');
			$table->timestamps();
        });
	}

}
