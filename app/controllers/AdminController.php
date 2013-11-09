<?php

class AdminController extends \BaseController {

    protected $foodService;
    protected $foodGroupService;

    /**
     * Constructor - set service objects.
     * 
     * @param $foodService
     * @param $$foodGroupService
     * @return void
     */
    public function __construct(FoodService $foodService, FoodGroupService $foodGroupService)
    {
      $this->foodService = $foodService;
      $this->foodGroupService = $foodGroupService;
    }

    /**
     * Show links to admin actions.
     *
     * @return View
     */
    public function index()
    {
        return View::make('admin.admin');
    }

    /**
     * Check to see if user is logged in and redirect accordingly.
     *
     * @return View
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
     *
     * @return Redirect
     */
    public function logout() 
    {
        Auth::logout();
        return Redirect::to('admin/login');
    }

    /**
     * Fetch a list of all the foods and return it to the view.
     *
     * @return View
     */
    public function listFood()
    {
        $foods = $this->foodService->findAll();
        return View::make('admin.listfoods', ['foods' => $foods]);
    }

    /**
     * Fetch a food object 
     *
     * @param $id
     * @return View
     */
    public function editFood($id)
    {
        $food = $this->foodService->find($id);
        $foodGroups = $this->foodGroupService->findAll();
        return View::make('admin.editfood', ['food' => $food, 'foodGroups' => $foodGroups]);
    }

    /**
     * Create a view to add new food.
     *
     * @return View
     */
    public function showAddFood()
    {
        return View::make('admin.addfood');
    }

    /**
     * Add a new food record to the database.
     *
     * @return Redirect
     */
    public function addFood()
    {
        $food = $this->foodService->create(Input::all());

        return Redirect::to('admin/food/list')->with('saved_message', 'Added food ' . $food->name); 
    }

    /**
     * Save a food record to the database.
     *
     * @return Redirect
     */
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
