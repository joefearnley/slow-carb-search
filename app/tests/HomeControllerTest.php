<?php

class HomeControllerTest extends TestCase {

	/**
	 * Test /
	 *
	 * @return void
	 */
	public function testIndex()
	{
		$this->call('GET', '/');
    $this->assertResponseOk();
  }
}