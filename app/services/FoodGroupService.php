<?php

class FoodGroupService {

    /**
     * Find all FoodGroup records
     *
     * @return collection
     */
    public function findAll()
    {
        return FoodGroup::all();
    }
}
