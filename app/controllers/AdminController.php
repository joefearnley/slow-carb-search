<?php

class AdminController extends \BaseController {

    protected $layout = 'admin.master';

    /**
     * Check to see if user is logged in and redirect accordingly.
     */
    public function showLogin()
    {
        // check login
        if (Auth::check()) {
            return Redirect::route('admin');
        } else {
            $this->layout->content = View::make('admin.login');
        }
    }

    /**
    * Log out user session and show login form.
    * 
    * @return Redirect
    */
    public function login()
    {
        $user = [
            'username' => strtolower(Input::get('username')), 
            'password' => Input::get('password')
        ];

        if (Auth::attempt($user, true)) {
            Session::put('username', $user['username']);
            return Redirect::route('admin');
        } else {
            $incorrectLoginMessage = 'Incorrect username and password. Please try again.';
            return Redirect::to('/admin/login')->with('login_error_message', $incorrectLoginMessage); 
        }
    }

    /**
    * Log out user session and show login form.
    */
    public function logout() 
    {
        Auth::logout();
        return Redirect::to('/admin/login');
    }

    /**
    * Show links to admin actions.
    *
    * @return Response
    */
    public function showAdmin()
    {
        $this->layout->content = View::make('admin.admin');
    }

    public function listFood()
    {
        $foods = Food::all();
        $this->layout->content = View::make('admin.listfoods', ['foods' => $foods]);
    }

    public function editFood($id)
    {
        $food = Food::find($id);
        $foodGroups = FoodGroup::all();
        $this->layout->content = View::make('admin.editfood', ['food' => $food, 'foodGroups' => $foodGroups]);
    }

    public function showAddFood()
    {
        $this->layout->content = View::make('admin.addfood');
    }

    public function addFood()
    {
        $name = Input::get('name');
        $description = Input::get('description');
        $allowed = Input::has('allowed') ? true : false;
        $allowedInModeration = Input::has('allowed-in-moderation') ? true : false;
        
        $food = new Food();
        $food->name = $name;
        $food->description = $description;
        $food->allowed = $allowed;
        $food->allowed_moderation = $allowedInModeration;
        $food->save();
        
        return Redirect::to('/admin/food/list')->with('saved_message', 'Added food ' . $food->name); 
    }

    public function saveFood()
    {
        $id = Input::get('id');
        $name = Input::get('name');
        $description = Input::get('description');
        $allowed = Input::has('allowed') ? true : false;
        $allowedInModeration = Input::has('allowed-in-moderation') ? true : false;
        
        $food = Food::find($id);
        $food->name = $name;
        $food->description = $description;
        $food->allowed = $allowed;  
        $food->allowed_moderation = $allowedInModeration;
        $food->save();

        return Redirect::to('/admin/food/list')->with('saved_message', $food->name . ' saved'); 
    }

}