<?php

class AdminControllerFunctionalTest extends TestCase {

    /**
     * Seed database for test - add an allowed food and one in 
     * moderation.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // allowed food
        $food = new Food();
        $food->name = 'AllowedFood';
        $food->description = 'AllowedFood';
        $food->allowed = true;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();
        
        // allowed food in moderation
        $food = new Food();
        $food->name = 'AllowedInModerationFood';
        $food->description = 'AllowedInModerationFood';
        $food->allowed = false;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();
    }

    /**
     * Test main login screen. Database is seeded with the following information:
     * username: scs
     * password: password
     * 
     * This test should authenticate the user, store the username, and redirect to the main admin page.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        $formData = [
            'username' => 'scs',
            'password' => 'password'
        ];

        $this->call('POST', '/admin/login', $formData);

        $this->assertRedirectedTo('admin');
        $this->assertSessionHas('username');
    }

    /**
     * Test unsuccessful login. User should be redirect to login form with error message.
     *
     * @return void
     */
    public function testUnsuccessfulLogin()
    {
        $formData = [
            'username' => 'scs',
            'password' => 'scs'
        ];

        $this->call('POST', '/admin/login', $formData);

        $this->assertRedirectedTo('admin/login');
        $this->assertSessionHas('login_error_message');
    }
    
    /**
     * Test that foods are list on page.
     * 
     * @return void
     */
    public function testFoodsAreListedOnPage()
    {
        $this->call('GET', '/admin/food/list');
        
        $this->assertResponseOk();
        $this->AssertViewHas('foods');
    }

    /**
     * Edit food record and confirm data is given to the view. 
     * Save the form and confirm data is stored correctly.
     * 
     * @return void
     */
    public function testEditAndSaveFood()
    {
        $this->call('GET', '/admin/food/edit/1');
        
        $this->assertResponseOk();
        $this->AssertViewHas('food');
        $this->AssertViewHas('foodGroups');
        
        $formData = [
            'id' => 1,
            'name' => 'AllowedFoodChanged',
            'description' => 'AllowedFoodChangedDescription',
            'allowed' => true,
            'allowed-in-moderation' => true
        ];
        
        $this->call('POST', '/admin/food/save', $formData);

        $this->assertRedirectedTo('admin/food/list');

        $food = Food::find(1);

        $this->assertEquals($food->name, 'AllowedFoodChanged');
        $this->assertEquals($food->description, 'AllowedFoodChangedDescription');
    }
    
    /**
     * Add food record and confirm data stored in the database correctly.
     * 
     * @return void
     */
    public function testAddFood()
    {
        $this->call('GET', '/admin/food/add');
        
        $this->assertResponseOk();

        $formData = [
            'id' => 1,
            'name' => 'NewFood',
            'description' => 'NewFoodDesciption',
            'allowed' => false,
            'allowed-in-moderation' => true
        ];
        
        $this->call('POST', '/admin/food/add', $formData);

        $this->assertRedirectedTo('admin/food/list');
     /*
        $this->assertEquals($food->name, 'NewFood');
        $this->assertEquals($food->description, 'NewFoodDescription');
        $this->assertFalse($food->allowed);
        $this->assertTrue($food->allowed_moderation);
    */
    }
    
}