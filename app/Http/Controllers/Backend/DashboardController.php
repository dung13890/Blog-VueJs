<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Contracts\Repositories\UserRepository;

class DashboardController extends BackendController
{
    public function __construct(UserRepository $repo)
    {
        parent::__construct($repo);
    }

    public function index()
    {
        $this->view = 'dashboard.index';
        $this->compacts['heading'] = $this->trans('dashboard');

        return $this->viewRender();
    }
}
