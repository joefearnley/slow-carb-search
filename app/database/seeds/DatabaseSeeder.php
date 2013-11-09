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

      //$this->call('FoodGroupTableSeeder');
      //$this->call('FoodTableSeeder');
      $this->call('UsersTableSeeder');
	}

}
