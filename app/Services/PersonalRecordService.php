<?php

namespace App\Services;

use App\Models\Movement;
use App\Models\PersonalRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonalRecordService
{
    /**
     * @param array $data
     * @return PersonalRecord
     */
    public function create(array $data): PersonalRecord
    {
        return PersonalRecord::create($data);
    }

    /**
     * @param int $id
     * @return PersonalRecord
     * @throws ModelNotFoundException
     */
    public function read(int $id): PersonalRecord
    {
        return PersonalRecord::findOrFail($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return PersonalRecord
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): PersonalRecord
    {
        $personalRecord = PersonalRecord::findOrFail($id);
        $personalRecord->update($data);
        return $personalRecord;
    }

    /**
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        $personalRecord = PersonalRecord::findOrFail($id);
        return $personalRecord->delete();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return PersonalRecord::all();
    }

    /**
     * Principal
     * @param int $movementId
     * @return array
     * @throws ModelNotFoundException
     */
    public function getMovementRanking(int $movementId): array
    {
        $movement = Movement::findOrFail($movementId);
        $personalRecords = PersonalRecord::select(
                'user_id',
                \DB::raw('MAX(value) as max_value'),
                \DB::raw('MIN(date) as min_date')
            )
            ->where('movement_id', $movementId)
            ->groupBy('user_id')
            ->orderBy('max_value', 'DESC')
            ->orderBy('min_date', 'ASC')
            ->get();

        $rankingData = [];
        foreach ($personalRecords as $record) {
            $user = User::find($record->user_id);

            $rankingData[] = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'value' => $record->max_value,
                'date' => $record->min_date,
            ];
        }

        $position = 1;
        $lastValue = null;
        $lastPosition = 1;

        foreach ($rankingData as $key => $data) {
            if ($lastValue === null || $lastValue != $data['value']) {
                $rankingData[$key]['position'] = $position;
                $lastPosition = $position;
            } else {
                $rankingData[$key]['position'] = $lastPosition;
            }

            $lastValue = $data['value'];
            $position++;
        }

        return [
            'movement_name' => $movement->name,
            'ranking' => $rankingData,
        ];
    }
}
