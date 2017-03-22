<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;

abstract class ApiController extends AbstractController
{
    protected $guard = 'api';

    protected $prefix = 'api.v1';

    protected $dataSelect = ['*'];

    protected function jsonRender($data = [])
    {
        $this->compacts['message'] = [
            'code' => 200,
            'status' => true,
        ];

        $compacts = array_merge($data, $this->compacts);

        return response()->json($compacts);
    }
}
