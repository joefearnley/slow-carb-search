<?php

class AdminControllerTest extends TestCase {

    /**
     * Test that main login form is shown
     *
     * @return void
     */
    public function testAdminIndex()
    {
        $this->call('GET', '/admin');

        $this->assertResponseOk();   
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

        $this->assertResponseStatus(200);
        $this->assertRedirectedTo('admin/login');

        $this->call('GET', 'food/list');
        $this->call('GET', 'food/edit/1');
        $this->call('POST', 'food/save');
        $this->call('GET', 'food/add');
        $this->call('POST', 'food/add');
    }

}