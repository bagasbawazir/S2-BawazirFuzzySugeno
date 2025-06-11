<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\MasterProduct;
use Illuminate\Database\Seeder;

class MasterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $master_products = [
            [
                'name_product' => 'Kopi Susu',
                'unit_product' => 'cup',
                'price_product' => 22000,
            ],

            [
                'name_product' => 'Kopi Americano',
                'unit_product' => 'cup',
                'price_product' => 18000,
            ],
            [
                'name_product' => 'Kopi Kapucino',
                'unit_product' => 'cup',
                'price_product' => 25000,
            ],
        ];

        foreach ($master_products as $value) {
            MasterProduct::create($value);
        }
    }
}
