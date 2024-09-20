<?php

namespace Tests\Unit;

use App\Models\PersonalRecord;
use App\Models\User;
use App\Models\Movement;
use App\Services\PersonalRecordService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonalRecordServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $personalRecordService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->personalRecordService = new PersonalRecordService();
    }

    /** @test */
    public function it_can_create_a_personal_record()
    {
        $user = User::factory()->create();
        $movement = Movement::factory()->create();

        $data = [
            'user_id' => $user->id,
            'movement_id' => $movement->id,
            'value' => 100.5,
            'date' => '2021-01-01 10:00:00',
        ];

        $personalRecord = $this->personalRecordService->create($data);

        $this->assertInstanceOf(PersonalRecord::class, $personalRecord);
        $this->assertDatabaseHas('personal_record', $data);
    }

    /** @test */
    public function it_can_read_a_personal_record()
    {
        $personalRecord = PersonalRecord::factory()->create();

        $foundPersonalRecord = $this->personalRecordService->read($personalRecord->id);

        $this->assertEquals($personalRecord->id, $foundPersonalRecord->id);
    }

    /** @test */
    public function it_can_update_a_personal_record()
    {
        $personalRecord = PersonalRecord::factory()->create();

        $data = [
            'value' => 150.0,
            'date' => '2021-01-02 12:00:00',
        ];

        $updatedPersonalRecord = $this->personalRecordService->update($personalRecord->id, $data);

        $this->assertEquals(150.0, $updatedPersonalRecord->value);
        $this->assertEquals('2021-01-02 12:00:00', $updatedPersonalRecord->date);
        $this->assertDatabaseHas('personal_record', [
            'id' => $personalRecord->id,
            'value' => 150.0,
            'date' => '2021-01-02 12:00:00',
        ]);
    }

    /** @test */
    public function it_can_delete_a_personal_record()
    {
        $personalRecord = PersonalRecord::factory()->create();

        $result = $this->personalRecordService->delete($personalRecord->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('personal_record', ['id' => $personalRecord->id]);
    }

    /** @test */
    public function it_can_get_movement_ranking()
    {
        $user1 = User::factory()->create(['name' => 'Joao']);
        $user2 = User::factory()->create(['name' => 'Jose']);
        $user3 = User::factory()->create(['name' => 'Paulo']);

        $movement = Movement::factory()->create(['name' => 'Deadlift']);

        PersonalRecord::create([
            'user_id' => $user1->id,
            'movement_id' => $movement->id,
            'value' => 180.0,
            'date' => '2021-01-02 00:00:00',
        ]);

        PersonalRecord::create([
            'user_id' => $user2->id,
            'movement_id' => $movement->id,
            'value' => 190.0,
            'date' => '2021-01-06 00:00:00',
        ]);

        PersonalRecord::create([
            'user_id' => $user3->id,
            'movement_id' => $movement->id,
            'value' => 170.0,
            'date' => '2021-01-01 00:00:00',
        ]);

        $ranking = $this->personalRecordService->getMovementRanking($movement->id);
        $this->assertEquals('Deadlift', $ranking['movement_name']);

        $expectedRanking = [
            [
                'user_id' => $user2->id,
                'user_name' => 'Jose',
                'value' => 190.0,
                'date' => '2021-01-06 00:00:00',
                'position' => 1,
            ],
            [
                'user_id' => $user1->id,
                'user_name' => 'Joao',
                'value' => 180.0,
                'date' => '2021-01-02 00:00:00',
                'position' => 2,
            ],
            [
                'user_id' => $user3->id,
                'user_name' => 'Paulo',
                'value' => 170.0,
                'date' => '2021-01-01 00:00:00',
                'position' => 3,
            ],
        ];

        $this->assertEquals($expectedRanking, $ranking['ranking']);
    }
}
