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
        $results = null;
        $input = '';
        if(Input::has('food'))
        {
            $results = $this->foodService->getSearchResults(Input::get('food'));
            $input =  $results->getSearchInput();
        }

        echo '<pre>';
        var_dump($results);
        die();

        return View::make('home.index')->withResults($results)->withInput($input);
    }

}
