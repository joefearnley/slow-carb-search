<?php

class ApiTest extends TestCase {

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

        $results = json_decode($response->getContent());

        var_dump($results);
        die();

        $this->assertTrue($results->food->allowed);

        $this->assertEquals('AllowedFood', $results->searchInput);
        $this->assertEquals(' is allowed on the Slow Carb Diet', $results->message);
        $this->assertNull($results->similarFoodName);
    }


}
