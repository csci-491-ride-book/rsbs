<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
                $this->call('BookPostingsTableSeeder');
                $this->call('MessagesTableSeeder');
                $this->call('PostingsTableSeeder');
                $this->call('RequestsTableSeeder');
                $this->call('RidePostingsTableSeeder');
	}

}