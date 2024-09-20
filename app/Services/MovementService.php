<?php

namespace App\Services;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MovementService
{
    /**
     * @param array $data
     * @return Movement
     */
    public function create(array $data): Movement
    {
        return Movement::create($data);
    }

    /**
     * @param int $id
     * @return Movement
     * @throws ModelNotFoundException
     */
    public function read(int $id): Movement
    {
        return Movement::findOrFail($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Movement
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): Movement
    {
        $movement = Movement::findOrFail($id);
        $movement->update($data);
        return $movement;
    }

    /**
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        $movement = Movement::findOrFail($id);
        return $movement->delete();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Movement::all();
    }
}
