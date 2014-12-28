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
     * Test call to the search API with input with no match on a food.
     *
     * @return void
     */
    public function testSearchResultsNoFoodFound()
    {
        $response = $this->client->request('GET', '/api/search?food=food Not Found');

        $this->assertTrue($this->client->getResponse()->isOk());

        $input = $response->filterXPath('//*[@id="input"]')->text();
        $this->assertEquals('food Not Found ', $input);
        
        $message = $response->filterXPath('//*[@id="message"]')->text();
        $this->assertEquals(' is not allowed on the Slow Carb Diet', $message);
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

        $input = $response->filterXPath('//*[@id="input"]')->text();
        $this->assertEquals('AllowedFood ', $input);

        $message = $response->filterXPath('//*[@id="message"]')->text();
        $this->assertEquals(' is allowed on the Slow Carb Diet', $message);

        $this->setExpectedException('InvalidArgumentException');
        $similarFood = $response->filterXPath('//*[@id="similar-food"]')->text();
    }

}
