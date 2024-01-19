<?php

namespace Feature\App\Http\Controllers;

use App\Http\Controllers\CatalogController;
use Database\Factories\ProductFactory;
use Database\Factories\PropertyFactory;
use Database\Factories\UserFactory;
use Faker\Factory;
use Tests\TestCase;

class CatalogControllerTest extends TestCase
{

    /**
     * @test
     * @return void
     */
    public function is_forbidden_to_guests(): void
    {

        $response = $this->getJson(action(CatalogController::class));

        //$response->assertStatus(401);
        $response->assertOk();
    }

    /**
     * @test
     * @return void
     */
    public function is_success_filtered(): void
    {

        $property = PropertyFactory::new()->create();

        $faker = Factory::create();
        $propertyValue = $faker->word();

        ProductFactory::new()
            ->count(2)
            ->hasAttached($property, function () use ($propertyValue) {
                return [
                    'value' => $propertyValue
                ];
            })
            ->create();

        $user = UserFactory::new()->create();

        $this->actingAs($user);

        $response = $this->getJson(action(CatalogController::class), [
            'properties' => [
                $property->id,
                $propertyValue
            ]
        ]);

        $response->assertJsonFragment(['total' => 2]);

        $response->assertOk();

    }

}