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
    $this->assertViewHas('food_name', '');
    $this->assertViewHas('is_isnot', null);
  }

  public function testFindSimilarFood()
  {
    $this->call('GET', '/search/chick');
    
    $this->assertResponseOk();
    $this->assertViewHas('food_name', 'chick');
    $this->assertViewHas('is_isnot', null);
    $this->assertViewHas('similar_food', null);
  }

}