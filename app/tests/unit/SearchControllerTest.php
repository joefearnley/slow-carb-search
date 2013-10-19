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

}