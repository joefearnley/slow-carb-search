<?php

class SearchControllerTest extends TestCase {

    /**
     * Confirm /search route is working and form is displayed
     *
     * @return void
     */
    public function testIndex()
    {
        $this->call('GET', '/search');

        $this->assertResponseOk();
    }

    /**
     * Test main form work and returns arguments. In this case they should be empty.
     *
     * @return void
     */
    public function testFindFood()
    {
        $response = $this->call('POST', '/search');

        $this->assertResponseOk();
        $this->assertViewHas('food_name', '');
        $this->assertViewHas('is_isnot', null);
    }

    /**
     * Test finding similar food funtionality.
     *
     * @return void
     */
    public function testFindSimilarFood()
    {
        $this->call('GET', '/search/chicken');

        $this->assertResponseOk();
        $this->assertViewHas('food_name', 'chicken');
        $this->assertViewHas('is_isnot', null);
        $this->assertViewHas('similar_food', null);
    }

    

}