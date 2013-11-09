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

        parent::insertFood();
        parent::insertFoodInModeration();
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
        $this->assertViewHas('food');
        $this->assertViewHas('searchInput', 'AllowedFood');
        $this->assertViewHas('message', ' is allowed on the Slow Carb Diet');
        $this->assertViewHas('similarFoodName', null);
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
        $this->assertViewHas('food');
        $this->assertViewHas('searchInput', 'Allowed');
        $this->assertViewHas('message', ' is not allowed on the Slow Carb Diet');
        $this->assertViewHas('similarFoodName', 'AllowedFood');   
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
        $this->assertViewHas('food');
        $this->assertViewHas('searchInput', 'MeatLoaf');
        $this->assertViewHas('message', ' is not allowed on the Slow Carb Diet');
        $this->assertViewHas('similarFoodName', null); 
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
        $this->assertViewHas('food');
        $this->assertViewHas('searchInput', 'AllowedInModerationFood');
        $this->assertViewHas('message', ' in moderation is allowed on the Slow Carb Diet');
        $this->assertViewHas('similarFoodName', null); 
    }

}
