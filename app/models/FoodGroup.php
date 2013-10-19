<?php

class FoodGroup extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'food_group';

    public static $unguarded = true;

    public function getName()
    {
        return $this->name;
    }

}