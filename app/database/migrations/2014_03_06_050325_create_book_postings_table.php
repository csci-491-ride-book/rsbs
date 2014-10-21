<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookPostingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('book_postings', function(Blueprint $table) {
            $table->increments('id');
			$table->string('title');
			$table->string('author');
			$table->string('ISBN');
			$table->string('condition');
			$table->string('edition');
			$table->string('class');
			$table->string('major');
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
	    Schema::drop('book_postings');
	}

}
