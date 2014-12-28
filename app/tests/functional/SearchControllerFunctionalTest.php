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

        $response = $this->call('POST', '/search', $formData);

        $this->assertResponseOk();

        $this->assertViewHas('results');

        $results = $response->original->getData()['results'];

        $this->assertEquals($results->getSearchInput(), 'AllowedFood');
        $this->assertEquals($results->getMessage(), ' is allowed on the Slow Carb Diet');
        $this->assertEquals($results->getSimilarFoodName(), null);
    }

    /**
     * Test search results return a similar food if input fits the criteria. 
     *
     * @return void
     */
    public function testFindSimilarFood()
    {
        $formData = ['food' => 'Allowed'];

        $response = $this->call('POST', '/search', $formData);

        $this->assertResponseOk();

        $this->assertViewHas('results');

        $results = $response->original->getData()['results'];

        $this->assertEquals($results->getSearchInput(), 'Allowed');
        $this->assertEquals($results->getMessage(), ' is not allowed on the Slow Carb Diet');
        $this->assertEquals($results->getSimilarFoodName(), 'AllowedFood');
    }

    /**
     * Test main search form for a food that is not allowed.
     *
     * @return void
     */
    public function testFindFoodWithFoodNotAllowed()
    {
        $formData = ['food' => 'MeatLoaf'];

        $response = $this->call('POST', '/search', $formData);

        $this->assertResponseOk();

        $this->assertViewHas('results');

        $results = $response->original->getData()['results'];

        $this->assertEquals($results->getSearchInput(), 'MeatLoaf');
        $this->assertEquals($results->getMessage(), ' is not allowed on the Slow Carb Diet');
        $this->assertEquals($results->getSimilarFoodName(), null);
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

        $response = $this->call('POST', '/search', $formData);

        $this->assertResponseOk();

        $this->assertViewHas('results');

        $results = $response->original->getData()['results'];

        $this->assertEquals($results->getSearchInput(), 'AllowedInModerationFood');
        $this->assertEquals($results->getMessage(), ' in moderation is allowed on the Slow Carb Diet');
        $this->assertEquals($results->getSimilarFoodName(), null);
    }

}