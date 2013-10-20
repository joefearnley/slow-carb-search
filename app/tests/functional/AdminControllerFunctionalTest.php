<?php

class AdminControllerFunctionalTest extends TestCase {

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

    public function test()
    {
        $formData = ['food' => 'AllowedFood'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'AllowedFood');
        $this->assertViewHas('is_isnot', ' is');
        $this->assertViewHas('similar_food', null);
    }

}