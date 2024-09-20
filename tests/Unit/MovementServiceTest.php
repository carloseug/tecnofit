<?php

namespace Tests\Unit;

use App\Models\Movement;
use App\Services\MovementService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovementServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $movementService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->movementService = new MovementService();
    }

    /** @test */
    public function it_can_create_a_movement()
    {
        $data = [
            'name' => 'Novo Movimento',
        ];

        $movement = $this->movementService->create($data);

        $this->assertInstanceOf(Movement::class, $movement);
        $this->assertDatabaseHas('movement', ['name' => 'Novo Movimento']);
    }

    /** @test */
    public function it_can_read_a_movement()
    {
        $movement = Movement::factory()->create();

        $foundMovement = $this->movementService->read($movement->id);

        $this->assertEquals($movement->id, $foundMovement->id);
    }

    /** @test */
    public function it_can_update_a_movement()
    {
        $movement = Movement::factory()->create(['name' => 'Movimento Antigo']);

        $data = [
            'name' => 'Movimento Atualizado',
        ];

        $updatedMovement = $this->movementService->update($movement->id, $data);

        $this->assertEquals('Movimento Atualizado', $updatedMovement->name);
        $this->assertDatabaseHas('movement', ['name' => 'Movimento Atualizado']);
    }

    /** @test */
    public function it_can_delete_a_movement()
    {
        $movement = Movement::factory()->create();

        $result = $this->movementService->delete($movement->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('movement', ['id' => $movement->id]);
    }
}
