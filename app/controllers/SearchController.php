<?php

class SearchController extends BaseController {

    protected $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    public function findFood()
    {
        if(Validator::Make(Input::all(), ['food' => 'required'])->fails()) {
            return Redirect::to('/search');
        }

        $results = $this->foodService->findFood(Input::get('food'));

        return View::make('home.results', $results);
    }

}