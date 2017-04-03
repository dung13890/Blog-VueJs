<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\AbstractController;
use Yajra\Datatables\Engines\EloquentEngine;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class BackendController extends AbstractController
{
    use DispatchesJobs;

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

    protected function doRequest(callable $callback, $action, $redirect = null)
    {
        \DB::beginTransaction();
        try {
            if (is_callable($callback)) {
                call_user_func_array($callback, []);
            }
            $this->e['message'] = $this->trans("object_{$action}_successfully");
            \DB::commit();
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            \DB::rollBack();
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans("object_{$action}_unsuccessfully");
        }

        if (\Request::ajax()) {
            return ($this->e['code'] == 0) ? response()->json($this->e) : response()->json($this->e, 400);
        }

        $redirect = $redirect ?: route($this->prefix . $this->repositoryName . '.index');

        return redirect($redirect)->with('flash_message', json_encode($this->e, true));
    }

    public function index(Request $request)
    {
        $this->view = $this->repositoryName . '.index';
        $this->compacts['heading'] = $this->trans('object.index');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function create()
    {
        $this->view = $this->repositoryName.'.create';
        $this->compacts['heading'] = $this->trans('object.create');
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
