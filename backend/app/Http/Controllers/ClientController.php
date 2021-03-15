<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Plan;
use App\Traits\RestActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller {
    private $_model = "App\\Models\\Client";
    use RestActions;

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        return $this->successResponse($this->_model::with('plans')->get());
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
        return $this->successResponse($items->with('plans')->first());
    }

    /**
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(): JsonResponse
    {
        $request = app('request');
        $this->validate($request,$this->_model::$rules);
        if ($client = $this->_model::create($request->all())) {
            if ($request->has('plans')) {
                $client->plans()->sync($request->get('plans'));
            }
        }
        return $this->successResponse($client, Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
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
        $model->plans()->sync($request->get('plans'));
        return $this->successResponse($model);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        if(is_null($client = $this->_model::find($id))){
            return $this->errorResponse(Response::HTTP_NOT_FOUND);
        }

        if (
            in_array(strtolower($client->state), Client::STATES_FREE)
            && count($client->plans)
            && $client->plans[0]->id == Plan::FREE
        ) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, "Clientes do plano FREE, do estado de São Paulo, não podem ser excluídos");
        }

        $this->_model::destroy($id);
        return $this->successResponse([], Response::HTTP_NO_CONTENT);
    }
}
