<?php

namespace Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SignInController;
use App\Http\Requests\LoginRequest;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    use RefreshDatabase;

    private Collection|Model $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create([
            'email' => 'testing@mail.ru',
            'phone' => '+71234567890',
            'password' => bcrypt(123456789)
        ]);

    }

    /**
     * @test
     * @return void
     */
    public function is_success_logged_by_phone(): void
    {

        $response = $this->post(action(SignInController::class), [
            'login' => 'testing@mail.ru',
            'password' => 123456789
        ]);

        $response->assertValid();
        $this->assertAuthenticatedAs($this->user);

    }

    /**
     * @test
     * @return void
     */
    public function is_success_logged_by_email(): void
    {

        $response = $this->post(
            action(SignInController::class),
            [
                'login' => 'testing@mail.ru',
                'password' => 123456789
            ]
        );

        $response->assertValid();
        $this->assertAuthenticatedAs($this->user);
    }

}