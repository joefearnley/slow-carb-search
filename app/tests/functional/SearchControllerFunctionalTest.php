<?php

class SearchControllerFunctionalTest extends TestCase {

    /**
     * Seed database for test - add an allowed food and one in moderation.
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

    /**
     * Test main search form. 
     *
     * @return void
     */
    public function testFindFoodWithFoodAllowed()
    {
        $formData = ['food' => 'AllowedFood'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'AllowedFood');
        $this->assertViewHas('message', ' is allowed on the Slow Carb Diet');
        $this->assertViewHas('similar_food', null);
    }

    /**
     * Test search results return a similar food if input fits the criteria. 
     *
     * @return void
     */
    public function testFindSimilarFood()
    {
        $formData = ['food' => 'Allowed'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'Allowed');
        $this->assertViewHas('message', ' is not allowed on the Slow Carb Diet');
        $this->assertViewHas('similar_food', 'AllowedFood');   
    }

    /**
     * Test main search form for a food that is not allowed.
     *
     * @return void
     */
    public function testFindFoodWithFoodNotAllowed()
    {
        $formData = ['food' => 'MeatLoaf'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'MeatLoaf');
        $this->assertViewHas('message', ' is not allowed on the Slow Carb Diet');
        $this->assertViewHas('similar_food', null); 
    }

    /**
     * Test main search form for a food allowed in moderation.
     *
     * @return void
     */
    public function testFindFoodWithFoodAllowedModeration()
    {
        $formData = ['food' => 'AllowedInModerationFood'];

        $this->call('POST', '/search', $formData);

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'AllowedInModerationFood');
        $this->assertViewHas('message', ' in moderation is allowed on the Slow Carb Diet');
        $this->assertViewHas('similar_food', null); 
    }

}