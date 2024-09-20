<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovementsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        DB::table('movement')->insert([
            [
                'id' => 1,
                'name' => 'Deadlift',
            ],
            [
                'id' => 2,
                'name' => 'Back Squat',
            ],
            [
                'id' => 3,
                'name' => 'Bench Press',
            ],
        ]);
    }
}
