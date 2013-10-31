<?php

class FoodService {

    public function findFood($foodName)
    {
        $similarFoodName = null;
        $food = null;
        $parameters = [$foodName];
        $foods = Food::whereRaw('upper(name) = upper(?)', $parameters)->get()->toArray();

        if(!empty($foods)) {
            $food = $foods[0];
            $foodName = $food['name'];
        } else {
            $similarFoodName = $this->findSimilarFoodName($foodName);
        }

        $message = $this->buildMessage($food);

        return [
            'food_name' => $foodName,
            'message' => $message,
            'similar_food' => $similarFoodName
        ];
    }
    
    public function findSimilarFoodName($partialFoodName)
    {
        $similarFoodName = null;
        $similarFoods = Food::where('name', 'like', $parameters)->get()->toArray();

        if(!empty($similarFoods)) {
            $similarFoodName = $similarFoods[0]['name'];
        }

        return $similarFoodName;
    }
    
    private function buildMessage($food)
    {
        $message = '';

        if($food['allowed']) {
            $message .= ' is allowed on the Slow Carb Diet';
        } else if($food['allowed_moderation']) {
            $message .= ' in moderation is allowed on the Slow Carb Diet';
        } else {
            $message .= ' is not allowed on the Slow Carb Diet';
        }
        
        return $message;
    }
}
