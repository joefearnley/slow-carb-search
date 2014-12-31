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
        $response = $this->client->request('GET', '/api/search?food=chicken');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test call to the search API with no input which should result in an error.
     *
     * @return void
     */
    public function testSearchResultsErrorNoInputProvided()
    {
        $response = $this->client->request('GET', '/api/search');

        $this->assertTrue($this->client->getResponse()->isOk());

        $data = $this->client->getResponse()->getData();

        $this->assertFalse($data->success);
        $this->assertEquals('No search input provided.', $data->message);
    }

    /**
     * Test call to the search API with input with no match on a food.
     *
     * @return void
     */
    public function testSearchResultsNoFoodFound()
    {
        $response = $this->client->request('GET', '/api/search?food=food Not Found');

        $this->assertTrue($this->client->getResponse()->isOk());

        $data = $this->client->getResponse()->getData();

        $this->assertTrue($data->success);
        $this->assertEquals('food Not Found', $data->results->searchInput);
        $this->assertEquals(' is not allowed on the Slow Carb Diet', $data->results->message);
    }

    /**
     * Test call to the search API with input with a match on a food.
     *
     * @return void
     */
    public function testSearchResultsFoodFound()
    {
        $response = $this->client->request('GET', '/api/search?food=AllowedFood');

        $this->assertTrue($this->client->getResponse()->isOk());

        $data = $this->client->getResponse()->getData();

        $this->assertTrue($data->success);
        $this->assertEquals('AllowedFood', $data->results->searchInput);
        $this->assertEquals(' is allowed on the Slow Carb Diet', $data->results->message);
    }

}
