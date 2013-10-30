<?php

class AdminControllerTest extends TestCase {

    /**
     * Enable filters for testing auth-protected routes
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Route::enableFilters();
    }

    /**
     * Test main login page displays OK
     *
     * @return void
     */
    public function testLogin()
    {
        $this->call('GET', '/admin/login');

        $this->assertResponseOk();
    }

    /**
     * Test logout page redirects properly
     *
     * @return void
     */
    public function testLogout()
    {
        $this->call('GET', '/admin/logout');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/admin/login');
    }

    /**
     * Test routes related to the admin controller that are protected
     * by the auth.admin filter
     *
     * @return void
     */
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
