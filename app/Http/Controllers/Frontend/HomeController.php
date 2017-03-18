<?php

namespace App\Http\Controllers\Frontend;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        parent::index();

        return $this->viewRender();
    }
}
