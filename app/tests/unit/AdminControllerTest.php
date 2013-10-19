<?php

class AdminControllerTest extends TestCase {

    /**
     * Test that main login form is shown
     *
     * @return void
     */
    public function testShowAdmin()
    {
        $this->call('GET', '/admin');

        $this->assertResponseOk();   
    }

    public function testLoginForm()
    {
        $this->call('GET', '/admin/login');

        $this->assertResponseOk();   
    }

    public function testLogoutForm()
    {
        $this->call('GET', '/admin/logout');

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/admin/login');
    }

}