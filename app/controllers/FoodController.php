<?php

class FoodController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return 'pizza pizza pizza pizza';
	}
  
  public function showAll()
  {
    $foods = Food::all();

    $results = [
      'error' => false,
      'foods' => $foods,
      200
    ];
    
    return Response::json($results);
  }

  public function search($foodName)
  {
    $parameters = [$foodName];
    $foods = Food::whereRaw('upper(name) = upper(?)', $parameters)->get()->toArray();
    $similarFoods = [];

    if(empty($foods)) {
      $parameters = ['%'.$foodName.'%'];
      $similarFoods = Food::whereRaw('upper(name) like ?', $parameters)->get()->toArray();
    }

    $results = [
      'error' => false,
      'foods' => $foods,
      'similar_foods' => $similarFoods,
      200
    ];

    return Response::json($results);
  }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $food
	 * @return Response
	 */
	public function show($food)
	{
    /*
    $foods = Food::where('name', 'LIKE', '%'.$food.'%')->get();
  
    $response = [
      'error' => false,
      'allowed' => 
    ];
 
    return Response::json(array(
        'error' => false,
        'urls' => $urls->toArray(),
        200
    );
    
    $foods = Food::all();
	*/
  }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}