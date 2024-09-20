<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementRequestValidator;
use App\Services\MovementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    protected $movementService;

    /**
     * @param MovementService $movementService
     */
    public function __construct(MovementService $movementService)
    {
        $this->movementService = $movementService;
    }

    /**
     * @param MovementRequestValidator $request
     * @return JsonResponse
     */
    public function create(MovementRequestValidator $request): JsonResponse
    {
        $validatedData = $request->validated();
        $movement = $this->movementService->create($validatedData);
        return response()->json($movement, 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        $movement = $this->movementService->read($id);
        return response()->json($movement);
    }

    /**
     * @param MovementRequestValidator $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MovementRequestValidator $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        $movement = $this->movementService->update($id, $validatedData);
        return response()->json($movement);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->movementService->delete($id);
        return response()->json(['message' => 'Movimento excluído com sucesso.']);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $movements = $this->movementService->getAll();
        return response()->json($movements);
    }
}
