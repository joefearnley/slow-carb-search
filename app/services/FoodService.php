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

    public function findAll()
    {
        return Food::all();
    }

    public function find($id)
    {
        return Food::find($id);
    }

    public function create($input)
    {
        $name = $input['name'];
        $description = $input['description'];
        $allowed = $input['allowed'] ? true : false;
        $allowedInModeration = $input['allowed-in-moderation'] ? true : false;

        $food = isset($input['id']) ? Food::find($input['id']) : new Food();

        $food->name = $name;
        $food->description = $description;
        $food->allowed = $allowed;
        $food->allowed_moderation = $allowedInModeration;
        $food->save();

        return $food;
    }
}
