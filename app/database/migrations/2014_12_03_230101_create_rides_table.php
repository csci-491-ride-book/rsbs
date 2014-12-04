<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRidesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rides', function(Blueprint $table)
		{
			$table->increments('id');

            // User ID - user id of the user that created the ride
            $table->integer('user_id');
            // Origin - city that the ride is departing from
            $table->string('origin');
            // Destination - city that the ride is going to
            $table->string('destination');
            // Date - date and time of departure
            $table->dateTime('date');
            // Seats - total number of seats offered for the ride
            $table->integer('seats');
            // Seat Price - price per seat
            $table->decimal('seat_price',8,2);

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
		Schema::drop('rides');
	}

}
