<?php

class SearchController extends BaseController {

    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function search()
    {
        if(Validator::Make(Input::all(), ['food' => 'required'])->fails()) {
            return Redirect::to('/search');
        }

        $searchResults = $this->searchService->getSearchResults(Input::get('food'));

//        var_dump($searchResults->toArray());
//        die();

        return View::make('home.results', $searchResults->toArray());
    }

}