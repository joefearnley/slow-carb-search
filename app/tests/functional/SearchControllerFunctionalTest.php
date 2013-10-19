<?php

class SearchControllerFunctionalTest extends TestCase {

    public function testFindFoodWithFoodAllowed()
    {
        $food = new Food();
        $food->name = 'TestFood';
        $food->description = 'TestingFood';
        $food->allowed = true;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();

        $formData = ['food' => 'Chicken'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'TestFood');
        $this->assertViewHas('is_isnot', ' is');
        $this->assertViewHas('similar_food', null);
    }

    public function testFindFoodWithFoodAllowedModeration()
    {
    }
    
    public function testFindFoodWithFoodNotAllowed()
    {
    }

}