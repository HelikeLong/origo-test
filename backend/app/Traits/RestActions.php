<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait RestActions {
    use ApiResponser;

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return $this->successResponse($this->_model::all());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function get($id): JsonResponse
    {
        $items = $this->_model::find($id);
        if(is_null($items)){
            return $this->errorResponse(Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($items);
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $request = app('request');
        $this->validate($request,$this->_model::$rules);
        return $this->successResponse($this->_model::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        $request = app('request');
        $this->validate($request,$this->_model::$rules);
        $model = $this->_model::find($id);
        if(is_null($model)){
            return $this->errorResponse(Response::HTTP_NOT_FOUND);
        }
        $model->update($request->all());
        return $this->successResponse($model);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        if(is_null($this->_model::find($id))){
            return $this->errorResponse(Response::HTTP_NOT_FOUND);
        }
        $this->_model::destroy($id);
        return $this->successResponse([], Response::HTTP_NO_CONTENT);
    }
}
