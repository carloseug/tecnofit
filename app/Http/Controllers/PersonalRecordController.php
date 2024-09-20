<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalRecordRequestValidator;
use App\Services\PersonalRecordService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MovementRankingRequest;

class PersonalRecordController extends Controller
{
    protected $personalRecordService;

    /**
     * @param PersonalRecordService $personalRecordService
     */
    public function __construct(PersonalRecordService $personalRecordService)
    {
        $this->personalRecordService = $personalRecordService;
    }

    /**
     * @param PersonalRecordRequestValidator $request
     * @return JsonResponse
     */
    public function create(PersonalRecordRequestValidator $request): JsonResponse
    {
        $validatedData = $request->validated();
        $personalRecord = $this->personalRecordService->create($validatedData);
        return response()->json($personalRecord, 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        $personalRecord = $this->personalRecordService->read($id);
        return response()->json($personalRecord);
    }

    /**
     * @param PersonalRecordRequestValidator $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(PersonalRecordRequestValidator $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        $personalRecord = $this->personalRecordService->update($id, $validatedData);
        return response()->json($personalRecord);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->personalRecordService->delete($id);
        return response()->json(['message' => 'Recorde pessoal excluído com sucesso.']);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $personalRecords = $this->personalRecordService->getAll();
        return response()->json($personalRecords);
    }

    /**
     * @param MovementRankingRequest $request
     * @param int $movement_id
     * @return JsonResponse
     */
    public function getMovementRanking(MovementRankingRequest $request, int $movement_id): JsonResponse
    {
        $ranking = $this->personalRecordService->getMovementRanking($movement_id);

        return response()->json($ranking);
    }
}
