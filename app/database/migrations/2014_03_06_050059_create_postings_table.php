<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('postings', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('book_posting_id')->nullable();
			$table->integer('ride_posting_id')->nullable();
			$table->integer('user_id');
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
	    Schema::drop('postings');
	}

}
