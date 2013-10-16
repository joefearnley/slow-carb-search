<?php
 
class UsersTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

   User::create([
      'username' => 'scs',
      'password' => Hash::make('password'),
      'email' => 'scs@slowcarbsearch.com'
    ]);
  
    User::create([
      'username' => 'joe',
      'password' => Hash::make('!Joe$ucks!'),
      'email' => 'joe.fearnley@gmail.com'
    ]);
  }
}