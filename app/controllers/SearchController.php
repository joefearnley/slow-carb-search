<?php

class SearchController extends BaseController {

    private $foodService;

    public function findFood()
    {
        $foodName = Input::get('food');

        $validator = Validator::Make(Input::all(), ['food' => 'required']);        
        if($validator->fails()) {
            return Redirect::to('/search');
        }
        
        $this->foodService = new FoodService();
        $results = $this->foodService->findFood($foodName);

        return View::make('home.results', $results);
    }

}