<?php
 
class FoodGroupTableSeeder extends Seeder {

  public function run()
  {
    DB::table('food_group')->delete();
    
    FoodGroup::create([
      'name' => 'Fruits',
      'description' => 'Focus on Fruits'
    ]);
    
    FoodGroup::create([
      'name' => 'Vegetables',
      'description' => 'Vary your veggies'
    ]);
        
    FoodGroup::create([
      'name' => 'Grains',
      'description' => 'Mike at least half you grains whole'
    ]);
          
    FoodGroup::create([
      'name' => 'Protein',
      'description' => 'Go lean with protein'
    ]);
  
    FoodGroup::create([
      'name' => 'Dairy',
      'description' => 'Get your calcium-rich foods'
    ]);
  }
}