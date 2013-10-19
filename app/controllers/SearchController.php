<?php

class SearchController extends BaseController {

    public function findFood()
    {
        $foodName = Input::get('food');

        $validator = Validator::Make(Input::all(), ['food' => 'required']);        
        if($validator->fails()) {
            return Redirect::to('/search');
        }

        $isIsNot = null;
        $similarFoodName = null;

        $parameters = [$foodName];
        $foods = Food::whereRaw('upper(name) = upper(?)', $parameters)->get()->toArray();

        if(!empty($foods)) {
            $food = $foods[0];
            $foodName = $food['name'];

            if($food['allowed']) {
                $isIsNot = ' is';
            } else if(!$food['allowed_moderation'] && $food['allowed_moderation']) {
                $isIsNot .= ' is not but allowed in moderation.';
            }
        } else {
            $isIsNot .= ' is not';
            
            // check for similar food 
            $parameters = ['%'.$foodName.'%'];
            $similarFoods = Food::whereRaw('name like ?', $parameters)->get()->toArray();
            
            if(!empty($similarFoods)) {
                $food = $similarFoods[0];
                $similarFoodName = $food['name'];
            }
        }

        $results = [
            'food_name' => $foodName,
            'is_isnot' => $isIsNot,
            'similar_food' => $similarFoodName
        ];
        
        return View::make('home.results', $results);
    }

}