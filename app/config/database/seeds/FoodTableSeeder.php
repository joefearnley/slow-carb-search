<?php
 
class FoodTableSeeder extends Seeder {

    public function run()
    {
        DB::table('food')->delete();

        Food::create([
            'name' => 'Chicken',
            'description' => 'Chicken',
            'allowed' => true,
            'allowed_moderation' => true,
            'food_group_id' => 4,
            'createdby' => 1
        ]);

        Food::create([
            'name' => 'Fish',
            'description' => 'Fish',
            'allowed' => true,
            'allowed_moderation' => true,
            'food_group_id' => 4,
            'createdby' => 1
        ]);

        Food::create([
            'name' => 'Steak',
            'description' => 'Steak',
            'allowed' => true,
            'allowed_moderation' => true,
            'food_group_id' => 4,
            'createdby' => 1
        ]);

        Food::create([
            'name' => 'Bread',
            'description' => 'Bread',
            'allowed' => false,
            'allowed_moderation' => false,
            'food_group_id' => 3,
            'createdby' => 1
        ]);

        Food::create([
            'name' => 'Salsa',
            'description' => 'Salsa',
            'allowed' => true,
            'allowed_moderation' => true,
            'food_group_id' => 4,
            'createdby' => 1
        ]);
    }
}