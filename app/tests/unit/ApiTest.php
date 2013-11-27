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

    public function testSearchResults()
    {
        $response = $this->call('GET', '/api/search/chicken');

        var_dump(json_decode($response->getContent()));

        die();

        $this->assertResponseOk();
    }

}
