<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{

    /**
    * Success response data format.
    */
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    /**
    * Error response data format.
    */
    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
    * Showing a collection.
    */
    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        return $this->successResponse($collection, $code);
    }

    /**
    * Showing a single model instance.
    */
    protected function showOne(Model $instanceModel, $code = 200)
    {
        return $this->successResponse($instanceModel, $code);
    }

    /**
    * Show with  message.
    */
    protected function showMessage($message, $code = 200)
    {
        return $this->successResponse(['data' => $message], $code);
    }
}
