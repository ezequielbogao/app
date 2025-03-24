<?php

namespace App\Traits;

trait ApiResponse
{
	/**
	 * @param bool $success Indica si la operación fue exitosa.
	 * @param mixed $data Los datos a devolver.
	 * @param string|null $message Mensaje opcional.
	 * @param int $code Código de respuesta HTTP (por defecto 200).
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function apiResponse(bool $success, $data = null, string $message = null, int $code = 200)
	{
		return response()->json([
			'success' 	=> $success,
			'message' 	=> $message ?? ($success ? 'Operación exitosa' : 'Ocurrió un error'),
			'data' 		=> $data,
			'code' 		=> $code
		], $code);
	}
}
