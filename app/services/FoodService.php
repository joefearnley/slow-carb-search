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
        $foods = Food::whereRaw('upper(name) = ? ',  [Str::upper($searchInput)])
                        ->orderBy('name', 'asc')
                        ->get();

        if(!$foods->isEmpty())
        {
            $this->searchResults->setFood($foods->first());
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
        $similarFoods = Food::where('name', 'like', "%$searchInput%")->get();

        if(!$similarFoods->isEmpty()) {
            $food = $similarFoods->first();
            return $food->name;
        }

        return null;
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
        $foodGroupId = $input['food-group'];
        $allowed = $input['allowed'] ? true : false;
        $allowedInModeration = $input['allowed-in-moderation'] ? true : false;

        $food->name = $name;
        $food->description = $description;
        $food->allowed = $allowed;
        $food->allowed_moderation = $allowedInModeration;
        $food->food_group_id = $foodGroupId;
        $food->createdby = !empty(Auth::user()) ? Auth::user()->id : 1;
        $food->save();

        return $food;
    }
}
