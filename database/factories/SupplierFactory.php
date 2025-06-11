<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_supplier' => $this->faker->name(),
            'phone_supplier' => $this->faker->unique()->phoneNumber(),
            'address_supplier' => $this->faker->unique()->address(),
            'description_supplier' => $this->faker->text(),
        ];
    }
}
