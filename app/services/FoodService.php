<?php

class FoodService {

    /**
     * @var SearchResults
     */
    private $searchResults;

    /**
     * Add a new food record to the database.
     *
     * @param $searchInput
     * @return Redirect
     */
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

    /**
     * Find first food record based on partial name.
     *
     * @param $searchInput
     * @return Food
     */
    public function findSimilarFoodName($searchInput)
    {
        $similarFoodName = null;
        $similarFoods = Food::where('name', 'like', "%$searchInput%")->get()->toArray();

        if(!empty($similarFoods)) {
            $similarFoodName = $similarFoods[0]['name'];
        }

        return $similarFoodName;
    }

    /**
     * Find and return all records in the food table.
     *
     * @return collection
     */
    public function findAll()
    {
        return Food::all();
    }

    /**
     * Find and return single
     *
     * @param $id
     * @return Food
     */
    public function find($id)
    {
        return Food::find($id);
    }

    /**
     * Create food record.
     *
     * @param $input
     * @return Food
     */
    public function create($input)
    {
        $food = new Food();
        return $this->save($input, $food);
    }

    /**
     * Update food record.
     *
     * @param $input
     * @return Food
     */
    public function update($input)
    {
        $food = Food::find($input['id']);
        return $this->save($input, $food);
    }

    /**
     * Save a food object to the database from form data.
     *
     * @param $input
     * @param $food
     * @return Food
     */
    protected function save($input, $food)
    {
        $name = $input['name'];
        $description = $input['description'];
        $allowed = $input['allowed'] ? true : false;
        $allowedInModeration = $input['allowed-in-moderation'] ? true : false;

        $food->name = $name;
        $food->description = $description;
        $food->allowed = $allowed;
        $food->allowed_moderation = $allowedInModeration;
        $food->save();

        return $food;
    }
}
