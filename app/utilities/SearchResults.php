<?php

class SearchResults {

    private $food;
    private $searchInput;
    private $message;
    private $similarFoodName;

    public function setFood($food)
    {
        $this->food = $food;
    }

    public function setSearchInput($searchInput)
    {
      $this->searchInput = $searchInput;
    }

    public function setSimilarFoodName($similarFoodName)
    {
        $this->similarFoodName = $similarFoodName;
    }

    public function buildMessage()
    {
        if($this->food['allowed']) {
            $this->message = ' is allowed on the Slow Carb Diet';
        } else if($this->food['allowed_moderation']) {
            $this->message = ' in moderation is allowed on the Slow Carb Diet';
        } else {
            $this->message = ' is not allowed on the Slow Carb Diet';
        }
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

}
