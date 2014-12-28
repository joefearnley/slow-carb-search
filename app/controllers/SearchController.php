<?php

class SearchController extends BaseController {

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
        if(!Input::has('food')) 
        {
            return Redirect::to('/search');
        }

        $results = $this->foodService->getSearchResults(Input::get('food'));

        return View::make('home.results')->withResults($results);
    }

}
