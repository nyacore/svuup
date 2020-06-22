<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * HTTP JSON response with no data and HTTP_CREATED status code
     */
    protected function httpCreated()
    {
        return response()->json([], Response::HTTP_CREATED);
    }

    /**
     * HTTP JSON response with no data and HTTP_NO_CONTENT status code
     */
    protected function httpNoContent()
    {
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
