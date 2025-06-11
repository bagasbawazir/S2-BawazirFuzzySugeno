<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\DetailPurchase;
use Illuminate\Database\Seeder;
use App\Models\MasterInggridient;

class DetailPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $detail_purchases = [
            [
                'id_purchase' => 1,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '02', '28'),
                'qty' => 28000,
                'total_price_inggridient' => 2240000,
            ],
            [
                'id_purchase' => 1,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '01', '30'),
                'qty' => 17000,
                'total_price_inggridient' => 680000,
            ],
            [
                'id_purchase' => 1,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2023', '07', '30'),
                'qty' => 6000,
                'total_price_inggridient' => 120000,
            ],
            [
                'id_purchase' => 2,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '03', '31'),
                'qty' => 21000,
                'total_price_inggridient' => 1680000,
            ],
            [
                'id_purchase' => 2,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '02', '28'),
                'qty' => 12000,
                'total_price_inggridient' => 480000,
            ],
            [
                'id_purchase' => 2,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2023', '08', '31'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 3,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '04', '30'),
                'qty' => 20000,
                'total_price_inggridient' => 1600000,
            ],
            [
                'id_purchase' => 3,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '03', '30'),
                'qty' => 12000,
                'total_price_inggridient' => 480000,
            ],
            [
                'id_purchase' => 3,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2023', '09', '30'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 4,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '05', '30'),
                'qty' => 25000,
                'total_price_inggridient' => 2000000,
            ],
            [
                'id_purchase' => 4,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '04', '30'),
                'qty' => 14000,
                'total_price_inggridient' => 560000,
            ],
            [
                'id_purchase' => 4,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2023', '10', '30'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 5,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '06', '30'),
                'qty' => 25000,
                'total_price_inggridient' => 2000000,
            ],
            [
                'id_purchase' => 5,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '05', '30'),
                'qty' => 14000,
                'total_price_inggridient' => 560000,
            ],
            [
                'id_purchase' => 5,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2023', '11', '30'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 6,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '07', '31'),
                'qty' => 22000,
                'total_price_inggridient' => 1760000,
            ],
            [
                'id_purchase' => 6,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '06', '30'),
                'qty' => 13000,
                'total_price_inggridient' => 520000,
            ],
            [
                'id_purchase' => 6,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2023', '12', '31'),
                'qty' => 4000,
                'total_price_inggridient' => 80000,
            ],
            [
                'id_purchase' => 7,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '08', '30'),
                'qty' => 22000,
                'total_price_inggridient' => 1760000,
            ],
            [
                'id_purchase' => 7,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '07', '30'),
                'qty' => 13000,
                'total_price_inggridient' => 520000,
            ],
            [
                'id_purchase' => 7,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2024', '01', '30'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 8,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '09', '28'),
                'qty' => 20000,
                'total_price_inggridient' => 1600000,
            ],
            [
                'id_purchase' => 8,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '08', '28'),
                'qty' => 11000,
                'total_price_inggridient' => 440000,
            ],
            [
                'id_purchase' => 8,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2024', '02', '28'),
                'qty' => 4000,
                'total_price_inggridient' => 80000,
            ],
            [
                'id_purchase' => 9,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '10', '31'),
                'qty' => 25000,
                'total_price_inggridient' => 2000000,
            ],
            [
                'id_purchase' => 9,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '09', '30'),
                'qty' => 15000,
                'total_price_inggridient' => 600000,
            ],
            [
                'id_purchase' => 9,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2024', '03', '31'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 10,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '11', '30'),
                'qty' => 21000,
                'total_price_inggridient' => 1680000,
            ],
            [
                'id_purchase' => 10,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '10', '30'),
                'qty' => 13000,
                'total_price_inggridient' => 520000,
            ],
            [
                'id_purchase' => 10,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2024', '04', '30'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
            [
                'id_purchase' => 11,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2022', '12', '31'),
                'qty' => 25000,
                'total_price_inggridient' => 2000000,
            ],
            [
                'id_purchase' => 11,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '11', '30'),
                'qty' => 13000,
                'total_price_inggridient' => 520000,
            ],
            [
                'id_purchase' => 11,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2024', '05', '31'),
                'qty' => 6000,
                'total_price_inggridient' => 120000,
            ],
            [
                'id_purchase' => 12,
                'id_inggridient' => 1,
                'date_expired' => Carbon::create('2023', '01', '30'),
                'qty' => 23000,
                'total_price_inggridient' => 1840000,
            ],
            [
                'id_purchase' => 12,
                'id_inggridient' => 2,
                'date_expired' => Carbon::create('2022', '12', '30'),
                'qty' => 13000,
                'total_price_inggridient' => 520000,
            ],
            [
                'id_purchase' => 12,
                'id_inggridient' => 3,
                'date_expired' => Carbon::create('2024', '06', '30'),
                'qty' => 5000,
                'total_price_inggridient' => 100000,
            ],
        ];

        foreach ($detail_purchases as $value) {
            DetailPurchase::create($value);
        }


        // foreach ($detail_purchases as $value) {
        //     DetailPurchase::create($value);
        //     $find_master_inggridient = MasterInggridient::find($value['id_inggridient'])->increment('qty_inggridient', $value['qty']);
        // }
    }
}
