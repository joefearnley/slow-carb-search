<?php

class FoodService {

    private $searchResults;

    public function getSearchResults($searchInput)
    {
        $this->searchResults = new SearchResults();

        $similarFoodName = null;
        $food = null;
        $parameters = [$searchInput];
        $foods = Food::whereRaw('upper(name) = upper(?)', $parameters)->get()->toArray();

        if(!empty($foods)) {
            $this->searchResults->setFood($foods[0]);
        } else {
            $this->searchResults->setSimilarFoodName($this->findSimilarFoodName($searchInput));
        }

        $this->searchResults->setSearchInput($searchInput);
        $this->searchResults->buildMessage();

        return $this->searchResults;
    }

    public function findSimilarFoodName($searchInput)
    {
        $similarFoodName = null;
        $similarFoods = Food::where('name', 'like', "%$searchInput%")->get()->toArray();

        if(!empty($similarFoods)) {
            $similarFoodName = $similarFoods[0]['name'];
        }

        return $similarFoodName;
    }
}
