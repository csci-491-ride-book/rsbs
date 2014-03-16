<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRideDateFromString extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ride_postings', function($table)
		{
		    $table->dropColumn('date');
		});

		Schema::table('ride_postings', function($table)
		{
		    $table->dateTime('date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ride_postings', function($table)
		{
		    $table->dropColumn('date');
		});

		Schema::table('ride_postings', function($table)
		{
		    $table->integer('date');
		});
	}

}
