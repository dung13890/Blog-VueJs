<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Jobs\User\StoreJob;
use App\Jobs\User\UpdateJob;
use App\Jobs\User\DeleteJob;
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

        return $this->doRequest(function () use ($data) {
            return $this->dispatch(new StoreJob($data));
        }, 'created');
    }

    public function edit($id)
    {
        parent::edit($id);
        $this->compacts['roles'] = $this->roles;
        $this->before(__FUNCTION__, $this->compacts['item']);

        return $this->viewRender();
    }

    public function update(Request $request, $id)
    {
        $item = $this->repository->findOrFail($id);
        $this->before(__FUNCTION__, $item);
        
        if (!$request->has('password')) {
            $request->replace($request->except(['password', 'password_confirmation']));
        }
        
        $this->validate($request, $this->repository->validation('update', $item));
        $data = $request->all();

        return $this->doRequest(function () use ($item, $data) {
            return $this->dispatch(new UpdateJob($item, $data));
        }, 'updated');
    }

    public function destroy($id)
    {
        $item = $this->repository->findOrFail($id);
        $this->before(__FUNCTION__, $item);

        return $this->doRequest(function () use ($item) {
            return $this->dispatch(new DeleteJob($item));
        }, 'deleted');
    }
}
