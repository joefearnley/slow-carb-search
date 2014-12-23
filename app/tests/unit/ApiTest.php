<?php

class ApiTest extends TestCase {

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
     * Test search api endpoint.
     *
     * @return void
     * */
    public function testSearch()
    {
        $this->call('GET', '/api/search/chicken');

        $this->assertResponseOk();
    }

    /**
     * Test call to the search API with input with no match on a food.
     *
     * @return void
     */
    public function testSearchResultsNoFoodFound()
    {
        $response = $this->call('GET', '/api/search/chicken');

        $this->assertResponseOk();

        $results = json_decode($response->getContent());

        $this->assertNull($results->food);
        $this->assertEquals('chicken', $results->searchInput);
        $this->assertEquals(' is not allowed on the Slow Carb Diet', $results->message);
        $this->assertNull($results->similarFoodName);
    }

    /**
     * Test call to the search API with input with a match on a food.
     *
     * @return void
     */
    public function testSearchResultsFoodFound()
    {
        $response = $this->call('GET', '/api/search/AllowedFood');

        $this->assertResponseOk();

        $result = json_decode($response->getContent());  // ?? toJson() or anothe utility in Laravel

        $allowed = (bool) $result->food->allowed;
        $this->assertTrue($allowed);

        $this->assertEquals('AllowedFood', $result->searchInput);
        $this->assertEquals(' is allowed on the Slow Carb Diet', $result->message);
        $this->assertNull($result->similarFoodName);
    }


}
