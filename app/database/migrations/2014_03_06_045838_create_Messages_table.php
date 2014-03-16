<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
			$table->string('content');
			$table->integer('to_id');
			$table->integer('from_id');
			$table->integer('posting_id');
			$table->string('date');
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
	    Schema::drop('messages');
	}

}
