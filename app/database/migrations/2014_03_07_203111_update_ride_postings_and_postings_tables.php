<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRidePostingsAndPostingsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ride_postings', function($table)
		{
		    $table->dropColumn('user_id');
		});

		Schema::table('postings', function($table)
		{
		    $table->integer('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::table('postings', function($table)
		{
		    $table->dropColumn('user_id');
		});
	}

}
