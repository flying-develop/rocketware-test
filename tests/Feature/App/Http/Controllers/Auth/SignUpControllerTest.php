<?php

namespace Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\SignUpController;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function is_invalid_email(): void
    {
        $response = $this->post(action(SignUpController::class), [
            'email' => 'testing'
        ]);

        $response->assertInvalid('email');
    }

    /**
     * @test
     * @return void
     */
    public function is_valid_email(): void
    {
        $response = $this->post(action(SignUpController::class), [
            'email' => 'testing@email.com'
        ]);

        $response->assertValid('email');
    }

    /**
     * @test
     * @return void
     */
    public function is_invalid_phone(): void
    {
        $response = $this->post(action(SignUpController::class), [
            'phone' => 'testing'
        ]);

        $response->assertInvalid('phone');
    }

    /**
     * @test
     * @return void
     */
    public function is_valid_phone(): void
    {
        $response = $this->post(action(SignUpController::class), [
            'phone' => '+71234567890'
        ]);

        $response->assertValid('phone');
    }

    /**
     * @test
     * @return void
     */
    public function is_valid_password(): void
    {
        $response = $this->post(action(SignUpController::class), [
            'password' => '%aZ123',
            'password_confirmation' => '%aZ123',
        ]);

        $response->assertValid('password');
    }

    /**
     * @test
     * @return void
     */
    public function is_success_register(): void
    {

        $this->assertDatabaseMissing('users', [
            'email' => 'testing@email.com'
        ]);

        $response = $this->post(action(SignUpController::class), [
            'name' => 'testing',
            'email' => 'testing@email.com',
            'phone' => '+71234567890',
            'password' => '%aZ123',
            'password_confirmation' => '%aZ123'
        ]);

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => 'testing@email.com'
        ]);

    }

}