<?php

class SearchController extends BaseController {

    protected $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    public function search()
    {
        if(!Input::get('food')) {
            return Redirect::to('/search');
        }

        $searchResults = $this->foodService->getSearchResults(Input::get('food'));

        return View::make('home.results', $searchResults->toArray());
    }

}
