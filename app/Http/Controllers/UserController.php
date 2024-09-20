<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequestValidator;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    /**
     * Construtor com injeção de dependência do UserService.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function read(int $id): JsonResponse
    {
        $user = $this->userService->read($id);
        return response()->json($user);
    }

    /**
     * @param UserRequestValidator $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserRequestValidator $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        $user = $this->userService->update($id, $validatedData);
        return response()->json($user);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(['message' => 'Usuário excluído com sucesso.']);
    }
}
