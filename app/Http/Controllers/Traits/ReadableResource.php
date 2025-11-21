<?php

namespace App\Http\Controllers\Traits;

Trait ReadableResource
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->repository->list());
    }

    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->repository->find($id));
    }
}
