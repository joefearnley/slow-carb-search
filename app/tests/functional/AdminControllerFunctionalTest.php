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

        //parent::insertFood();
        //parent::insertFoodInModeration();
    }

    /**
     * Test main login screen. Database is seeded with the following information:
     * username: scs
     * password: password
     * 
     * This test should authenticate the user, store the username, 
     * and redirect to the main admin page.
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
            'name' => 'NewFood',
            'description' => 'NewFoodDesrciption',
            'allowed' => '',
            'allowed-in-moderation' => 'checked'
        ];

        $this->call('POST', '/admin/food/add', $formData);

        $this->assertRedirectedTo('admin/food/list');

        $maxId = DB::table('food')->max('id');
        $food = Food::find($maxId);

        $this->assertEquals($food->name, 'NewFood');
        $this->assertEquals($food->description, 'NewFoodDesrciption');
        $this->assertEquals($food->allowed, 0);
        $this->assertEquals($food->allowed_moderation, 1);
    }

}
