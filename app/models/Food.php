<?php

class Food extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'food';

    public static $unguarded = true;

    public function getFoodGroup()
    {
        return FoodGroup::find($this->food_group_id)->getName();
    }

    public function getAllowedAsString()
    {
        return ($this->allowed === 1) ? "yes" : "no";
    }

    public function getAllowedInModerationAsString()
    {
        return ($this->allowed_moderation == 1) ? "yes" : "no";
    }
    
    public function getAllowedChecked()
    {
        return ($this->allowed == 1) ? "checked" : "";
    }

    public function getAllowedInModerationChecked()
    {
        return ($this->allowed_moderation == 1) ? "checked" : "";
    }
    
    public function getItems() {
        return $this->items;
    }

}