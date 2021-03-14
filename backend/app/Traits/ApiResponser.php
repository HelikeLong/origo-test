<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser {

	/**
	 * Success json response
	 *
	 * @param array|Model $data
	 * @param string|null $message
	 * @param integer|null $code
	 * @return JsonResponse
	 */
    protected function successResponse($data, $message = null, $code = Response::HTTP_OK): JsonResponse
	{
		$response = [
			'status'=> 'Success',
			'message' => $message,
			'data' => $data
		];
		if (isset($data['data'])) {
			$response['data'] = $data['data'];
			unset($data['data']);
		}
		if (isset($data['current_page'])) {
			$response['pagination'] = $data;
		}

		return response()->json($response, $code);
	}

	/**
	 * Error json response
	 *
	 * @param string|array|null $data
	 * @param integer|null $code
	 * @return JsonResponse
	 */
	protected function errorResponse($code = Response::HTTP_BAD_REQUEST, $data = null): JsonResponse
	{
		$response = [
			'status'=>'Error',
			'message' => $data,
			'data' => null
		];
		if (is_array($data)) {
			if (isset($data['field'])) {
				$response['data'] = ['field' => $data['field']];
			}
			$response['message'] = $data['message'];
		}

		return response()->json($response, $code);
	}

}
