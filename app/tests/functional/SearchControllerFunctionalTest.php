<?php

class SearchControllerFunctionalTest extends TestCase {

    /**
     * Seed database for test - add an allowed food and one in 
     * moderation.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // allowed food
        $food = new Food();
        $food->name = 'AllowedFood';
        $food->description = 'AllowedFood';
        $food->allowed = true;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();
        
        // allowed food in moderation
        $food = new Food();
        $food->name = 'AllowedInModerationFood';
        $food->description = 'AllowedInModerationFood';
        $food->allowed = false;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();
    }

    public function testFindFoodWithFoodAllowed()
    {
        $formData = ['food' => 'AllowedFood'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'AllowedFood');
        $this->assertViewHas('is_isnot', ' is');
        $this->assertViewHas('similar_food', null);
    }

    public function testFindSimilarFood()
    {
        $formData = ['food' => 'Allowed'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'Allowed');
        $this->assertViewHas('is_isnot', ' is not');
        $this->assertViewHas('similar_food', 'AllowedFood');   
    }

    public function testFindFoodWithFoodNotAllowed()
    {
        $formData = ['food' => 'MeatLoaf'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'MeatLoaf');
        $this->assertViewHas('is_isnot', ' is not');
        $this->assertViewHas('similar_food', null); 
    }

    public function testFindFoodWithFoodAllowedModeration()
    {
        $formData = ['food' => 'AllowedInModerationFood'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'AllowedInModerationFood');
        $this->assertViewHas('is_isnot', ' in moderation is');
        $this->assertViewHas('similar_food', null); 
    }

}