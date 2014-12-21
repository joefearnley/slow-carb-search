<?php

class HomeController extends BaseController {

    /**
     * Display main search page.
     *
     * @return View
     */
    public function index()
    {
        return View::make('home.index');
    }

	public function showWelcome()
	{
		return View::make('hello');
	}

}
