<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AbstractController;

abstract class BackendController extends AbstractController
{
    protected $guard = 'backend';

    protected $prefix = 'backend.';

    protected $view;

    protected $dataSelect = ['*'];

    public function viewRender($data = [], $view = null)
    {
        $view = $view ?: $this->view;
        $compacts = array_merge($data, $this->compacts);

        return view($this->prefix . $view, $compacts);
    }

    public function index()
    {
        $this->view = $this->repositoryName . '.index';
        $this->compacts['heading'] = $this->trans('object.index');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function show($id)
    {
        $this->view = $this->repositoryName . '.show';
        $this->compacts['item'] = $this->repository->findOrFail($id);
        $this->compacts['heading'] = $this->trans('object.show');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function edit($id)
    {
        $this->view = $this->repositoryName . '.edit';
        $this->compacts['item'] = $this->repository->findOrFail($id);
        $this->compacts['heading'] = $this->trans('object.edit');
        $this->compacts['resource'] = $this->repositoryName;
    }
}
