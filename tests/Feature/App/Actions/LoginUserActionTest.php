<?php

namespace Feature\App\Actions;

use App\Actions\LoginUserAction;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_login_action_worked(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'testing@mail.ru',
            'password' => bcrypt(123456789)
        ]);

        $action = app(LoginUserAction::class);

        $action([
            'email' => 'testing@mail.ru',
            'password' => 123456789
        ]);

        $this->assertAuthenticatedAs($user);

    }
}