<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductInggridient;

class ProductInggridientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $product_inggridients = [
            [
                'id_product' => 1,
                'id_inggridient' => 1,
                'usage_amount' => 18,
            ],
            [
                'id_product' => 1,
                'id_inggridient' => 2,
                'usage_amount' => 10,
            ],
            [
                'id_product' => 2,
                'id_inggridient' => 1,
                'usage_amount' => 19,
            ],
            [
                'id_product' => 2,
                'id_inggridient' => 3,
                'usage_amount' => 6,
            ],
            [
                'id_product' => 3,
                'id_inggridient' => 1,
                'usage_amount' => 15,
            ],
            [
                'id_product' => 3,
                'id_inggridient' => 2,
                'usage_amount' => 20,
            ],
            [
                'id_product' => 3,
                'id_inggridient' => 3,
                'usage_amount' => 5,
            ],
        ];

        foreach ($product_inggridients as $value) {
            ProductInggridient::create($value);
        }
    }
}
