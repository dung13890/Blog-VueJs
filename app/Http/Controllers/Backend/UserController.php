<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use Silber\Bouncer\Bouncer;

class UserController extends BackendController
{
    protected $dataSelect = ['id', 'name', 'username', 'email', 'locked'];

    protected $roles;

    public function __construct(UserRepository $user, Bouncer $bouncer)
    {
        parent::__construct($user);
        $this->roles = $bouncer->role()->where('id', '<>', 1)->pluck('name', 'id')->prepend('All', 0);
    }

    public function index(Request $request)
    {
        $this->before(__FUNCTION__);
        parent::index($request);
        $this->compacts['roles'] = $this->roles;

        if ($request->ajax() && $request->has('datatables')) {
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect))
                ->filter(function ($query) use ($request) {
                    if ($request->has('keyword')) {
                        $query->byKeyword($request->keyword);
                    }

                    if ($request->has('role_id') && $roleId = $request->role_id) {
                        $query->byRole($request->role_id);
                    }
                });
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }
}
