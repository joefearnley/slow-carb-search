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
     * Test submit empty form. No error is display and redirected.
     *
     * @return void
     */
    public function testFindFoodEmptyForm()
    {
        $response = $this->call('POST', '/search');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/search');
    }
    
    public function testFindFoodWithFoodAllowed()
    {
        $food = new Food();
        $food->name = 'Chicken';
        $food->description = 'Chicken';
        $food->allowed = 1;
        $food->allowed_moderation = 1;
        $food->food_group_id =  = 'Chicken';
        $food->createdby 
        
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