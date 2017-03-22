<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\AbstractController;
use Yajra\Datatables\Engines\EloquentEngine;

abstract class BackendController extends AbstractController
{
    protected $guard = 'backend';

    protected $prefix = 'backend.';

    protected $view;

    protected $dataSelect = ['*'];

    protected $e = [
        'code' => 0,
        'message' => null,
    ];

    protected function viewRender($data = [], $view = null)
    {
        $view = $view ?: $this->view;
        $compacts = array_merge($data, $this->compacts);

        return view($this->prefix . $view, $compacts);
    }

    protected function filterDatatable(EloquentEngine $datatables, array $params, callable $callback = null)
    {
        return $datatables->filter(function ($query) use ($params, $callback) {
            if (array_has($params, 'keyword')) {
                $query->byKeyword($params['keyword']);
            }
            if (is_callable($callback)) {
                call_user_func_array($callback, [$query, $params]);
            }
        });
    }

    protected function columnDatatable(EloquentEngine $datatable)
    {
        return $datatable->addColumn('actions', function ($item) {
            $actions = [];
                if ($this->before('show', $item, false)) {
                    $actions['show'] = [
                        'uri' => route($this->prefix . $this->repositoryName . '.show', $item->id),
                        'label' => $this->trans('show'),
                    ];
                }
                if ($this->before('edit', $item, false)) {
                    $actions['edit'] = [
                        'uri' => route($this->prefix . $this->repositoryName . '.edit', $item->id),
                        'label' => $this->trans('edit'),
                    ];
                }
                if ($this->before('delete', $item, false)) {
                    $actions['delete'] = [
                        'uri' => route($this->prefix . $this->repositoryName . '.destroy', $item->id),
                        'label' => $this->trans('delete'),
                    ];
                }

            return $actions;
        });
    }

    protected function deleteData($id)
    {
        try {
            $entity = $this->repository->findOrFail($id);
            $this->before('delete', $entity);
            $this->repository->remove($entity);
            $this->e['message'] = $this->trans('object_deleted_successfully');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            $this->e['code'] = $e->getCode();
            $this->e['message'] = $this->trans('object_deleted_unsuccessfully');
            
            return response()->json($this->e, 400);
        }

        return response()->json($this->e);
    }

    public function index(Request $request)
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
