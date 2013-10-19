<?php

class HomeControllerTest extends TestCase {
  
  /**
    * Test main index page is displayed properly:
    *
    * @return void
    */
    public function testIndex()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
    }
}