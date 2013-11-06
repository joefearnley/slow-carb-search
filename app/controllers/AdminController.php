<?php

class AdminController extends \BaseController {

    /**
     * Show links to admin actions.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('admin.admin');
    }

    /**
     * Check to see if user is logged in and redirect accordingly.
     */
    public function showLogin()
    {
        return View::make('admin.login');
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
            return Redirect::to('admin');
        }

        $incorrectLoginMessage = 'Incorrect username and password. Please try again.';
        return Redirect::to('admin/login')->with('login_error_message', $incorrectLoginMessage); 
    }

    /**
     * Log out user session and show login form.
     */
    public function logout() 
    {
        Auth::logout();
        return Redirect::to('admin/login');
    }

    public function listFood()
    {
        $foods = Food::all();
        return View::make('admin.listfoods', ['foods' => $foods]);
    }

    public function editFood($id)
    {
        $food = Food::find($id);
        $foodGroups = FoodGroup::all();
        return View::make('admin.editfood', ['food' => $food, 'foodGroups' => $foodGroups]);
    }

    public function showAddFood()
    {
        return View::make('admin.addfood');
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

        return Redirect::to('admin/food/list')->with('saved_message', 'Added food ' . $food->name); 
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

        return Redirect::to('admin/food/list')->with('saved_message', $food->name . ' saved'); 
    }

}
