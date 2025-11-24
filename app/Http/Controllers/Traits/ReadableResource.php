<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait ReadableResource
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $eagerLoads = $request->query('with');
        if (!empty($eagerLoads)) {
            $eagerLoads = is_array($eagerLoads) ? $eagerLoads : [$eagerLoads];
        }
        Log::debug(
            "Requesting " . $this->repository::class . " list",
            ['with' => $eagerLoads]
        );
        return response()->json($this->repository->list(with: $eagerLoads ?? []));
    }

    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->repository->find($id));
    }
}
