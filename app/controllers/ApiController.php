<?php

class ApiController extends BaseController {

    /**
     * @var FoodService
     */
    protected $foodService;

    /**
     * Search for a food or similar food.
     *
     * @param object $foodService
     * @return void
     */
    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    /**
     * Search for a food or similar food.
     *
     * @return View
     */
    public function search()
    {
        $response = [];
        if(!Input::has('food')) 
        {
            $response['success'] = false;
            $response['message'] = 'No search input provided.';
            return Response::json($response);
        }

        $results = $this->foodService->getSearchResults(Input::get('food'));

        $response['success'] = true;
        $response['results'] = $results->toArray();

        return Response::json($response);
    }

}
