<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Database\Factories\PropertyFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $properties = PropertyFactory::new()
            ->count(10)
            ->create();

        $faker = Factory::create();

        ProductFactory::new()
            ->count(rand(5, 50))
            ->hasAttached($properties, function () use ($faker) {
                return [
                    'value' => ucfirst($faker->word())
                ];
            })
            ->create();
    }
}
