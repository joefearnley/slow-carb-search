<?php

class SearchController extends BaseController {

    /**
     * @var FoodService
     */
    protected $foodService;

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
        if(!Input::get('food')) {
            return Redirect::to('/search');
        }

        $searchResults = $this->foodService->getSearchResults(Input::get('food'));

        return View::make('home.results', $searchResults->toArray());
    }

}
