<?php

class SearchControllerTest extends TestCase {

	/**
	 * Test /search
	 *
	 * @return void
	 */
	public function testIndex()
	{
    $this->call('GET', '/search');
    $this->assertResponseOk();
  }

  public function testFindFood()
  {
    $response = $this->call('POST', '/search');

    $this->assertResponseOk();
    $this->assertViewHas('is_isnot');
    $this->assertViewHas('food_name');
  }

  public function testFindSimilarFood()
  {
    $this->call('GET', '/search/chicken');
    
    $this->assertResponseOk();
    $this->assertViewHas('food_name');
    $this->assertViewHas('is_isnot');
    $this->assertViewHas('similar_food');
  }
}