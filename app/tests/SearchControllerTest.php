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
    
    $response = $this->action('GET', 'HomeController@index');
    var_dump($response);
  }

  public function testFindFood()
  {
    $response = $this->call('POST', '/search');
    $this->assertResponseOk();
    
    //var_dump($response->getOriginalContent());
    
    //$this->assertViewHas('food_name');
  }

  public function testFindSimilarFood()
  {
    $this->call('GET', '/search/chicken');
    $this->assertResponseOk();
  }
}