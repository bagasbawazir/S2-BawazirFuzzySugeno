<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $digits = 15;
        $min = pow(10, $digits - 1);
        $max = pow(10, $digits) - 1;

        $purchases = [
            [
                'id_user' => 1,
                'id_supplier' => 4,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2021', '07')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 1,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2021', '08')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 3,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2021', '09')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 6,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2021', '10')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 2,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2021', '11')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 1,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2021', '12')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 2,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2022', '01')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 3,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2022', '02')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 9,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2022', '03')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 2,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2022', '04')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 7,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2022', '05')->endOfMonth(),
            ],
            [
                'id_user' => 1,
                'id_supplier' => 6,
                'qty_purchase_inggridient' => 3,
                'description_purchase' => 'No Resi = ' . mt_rand($min, $max),
                'date_purchase' => Carbon::create('2022', '06')->endOfMonth(),
            ],
        ];

        foreach ($purchases as $value) {
            Purchase::create($value);
        }
    }
}
