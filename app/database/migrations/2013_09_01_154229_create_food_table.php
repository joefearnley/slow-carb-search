<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('food', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->boolean('allowed');
            $table->boolean('allowed_moderation');
            $table->integer('food_group_id');
            $table->integer('createdby');
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
		Schema::drop('food');
	}

}
