<?php

namespace Database\Factories;

use App\Models\PersonalRecord;
use App\Models\User;
use App\Models\Movement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalRecordFactory extends Factory
{
    protected $model = PersonalRecord::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'movement_id' => Movement::factory(),
            'value' => $this->faker->randomFloat(2, 50, 200),
            'date' => $this->faker->dateTime(),
        ];
    }
}
