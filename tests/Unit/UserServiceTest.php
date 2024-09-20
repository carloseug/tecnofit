<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userService = new UserService();
    }

    /** @test */
    public function it_can_read_a_user()
    {
        $user = User::factory()->create();

        $foundUser = $this->userService->read($user->id);

        $this->assertEquals($user->id, $foundUser->id);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Novo Nome',
            'email' => 'novoemail@example.com',
            'password' => 'novasenha',
        ];

        $updatedUser = $this->userService->update($user->id, $data);

        $this->assertEquals('Novo Nome', $updatedUser->name);
        $this->assertEquals('novoemail@example.com', $updatedUser->email);
        $this->assertTrue(Hash::check('novasenha', $updatedUser->password));
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $result = $this->userService->delete($user->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
