<?php

class SearchControllerFunctionalTest extends TestCase {

    public function testFindFoodWithFoodAllowed()
    {
        $response = $this->call('POST', '/search');

        $this->assertResponseOk();
        $this->assertViewHas('food_name', '');
        $this->assertViewHas('is_isnot', null);
        $this->assertViewHas('similar_food', null);
    }

    public function testFindFoodWithFoodAllowedModeration()
    {
    }
    
    public function testFindFoodWithFoodNotAllowed()
    {
    }

}