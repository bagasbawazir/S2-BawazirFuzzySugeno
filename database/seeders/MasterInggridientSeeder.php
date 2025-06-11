<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterInggridient;

class MasterInggridientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $master_inggridients = [
            [
                'name_inggridient' => 'Biji Kopi',
                'qty_inggridient' => 0,
                'unit_inggridient' => 'gr',
                'price_inggridient' => 80,
                'duration_expired' => '7',
                'time_expired' => 'month',
            ],
            [
                'name_inggridient' => 'Susu',
                'qty_inggridient' => 0,
                'unit_inggridient' => 'ml',
                'price_inggridient' => 40,
                'duration_expired' => '6',
                'time_expired' => 'month',
            ],
            [
                'name_inggridient' => 'Gula',
                'qty_inggridient' => 0,
                'unit_inggridient' => 'gr',
                'price_inggridient' => 20,
                'duration_expired' => '12',
                'time_expired' => 'month',
            ],
        ];

        foreach ($master_inggridients as $value) {
            MasterInggridient::create($value);
        }
    }
}
