<?php

class HomeController extends \BaseController {

  protected $layout = 'home.master';

	public function index()
	{
    return View::make('home.index');
	}

}