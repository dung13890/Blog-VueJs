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
        $this->roles = $bouncer->role()->where('id', '<>', 1)->pluck('name', 'id');
    }

    public function index(Request $request)
    {
        $this->before(__FUNCTION__);
        parent::index($request);
        $this->compacts['roles'] = $this->roles->prepend('All', 0);

        if ($request->ajax() && $request->has('datatables')) {
            $params = $request->all();
            $datatables = \Datatables::of($this->repository->datatables($this->dataSelect));
            $this->filterDatatable($datatables, $params, function ($query, $params) {
                if (array_has($params, 'role_id') && $params['role_id']) {
                    $query->byRole($params['role_id']);
                }
            });
                
            return $this->columnDatatable($datatables)->make(true);
        }

        return $this->viewRender();
    }

    public function create()
    {
        $this->before(__FUNCTION__);
        parent::create();
        $this->compacts['roles'] = $this->roles;
        
        return $this->viewRender();
    }

    public function store(Request $request)
    {
        $this->before(__FUNCTION__);
        $this->validate($request, $this->repository->validation('store'));
        $data = $request->all();

        return $this->storeData($data);
    }

    public function edit($id)
    {
        parent::edit($id);
        $this->compacts['roles'] = $this->roles;
        $this->before(__FUNCTION__, $this->compacts['item']);

        return $this->viewRender();
    }

    public function destroy($id)
    {
        return $this->deleteData($id);
    }
}
