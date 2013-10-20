<?php

class AdminControllerTest extends TestCase {

    public function setUp()
    {
        parent::setUp();

        Route::enableFilters();
    }

    public function testLogin()
    {
        $this->call('GET', '/admin/login');

        $this->assertResponseOk();
    }

    public function testLogout()
    {
        $this->call('GET', '/admin/logout');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/admin/login');
    }
    
    public function testAdminProtectedRoutes()
    {
        $this->call('GET', '/admin');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('admin/login');
        $this->assertSessionHas('login_error_message');


        $this->call('GET', '/admin/food/list');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('admin/login');
        $this->assertSessionHas('login_error_message');

        $this->call('GET', '/admin/food/edit/1');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('admin/login');
        $this->assertSessionHas('login_error_message');

        $this->call('GET', '/admin/food/add');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('admin/login');
        $this->assertSessionHas('login_error_message');
    }

}