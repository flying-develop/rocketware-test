<?php

namespace Feature\App\Actions;

use App\Actions\RegisterUserAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterUserActionTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_register_action_worked(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'testing@mail.ru'
        ]);

        $action = app(RegisterUserAction::class);

        $token = $action([
            'name' => 'test',
            'email' => 'testing@mail.ru',
            'phone' => '+71234567890',
            'password' => 123456789
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'testing@mail.ru'
        ]);


    }
}