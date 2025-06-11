<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\InggridientHistory;
use Illuminate\Support\Facades\DB;

class InggridientHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $getAllPurchase = DB::table('purchases')
            ->join('detail_purchases', 'purchases.id_purchase', '=', 'detail_purchases.id_purchase')
            ->join('master_inggridients', 'master_inggridients.id_inggridient', '=', 'detail_purchases.id_inggridient')
            ->select(DB::raw('purchases.date_purchase, MONTH(purchases.date_purchase) AS MONTH, YEAR(purchases.date_purchase) AS YEAR, master_inggridients.id_inggridient, detail_purchases.qty'))
            ->groupByRaw('master_inggridients.id_inggridient, MONTH(purchases.date_purchase), YEAR(purchases.date_purchase)')
            ->get();

        foreach ($getAllPurchase as $purchase) {
            InggridientHistory::updateOrCreate(
                [
                    'id_inggridient' => $purchase->id_inggridient,
                    'date' => Carbon::create(Carbon::create($purchase->date_purchase)->format('Y'), Carbon::create($purchase->date_purchase)->format('n'), '01'),
                ],
                ['purchase' => $purchase->qty],
            );
        }

        $getAllSale = DB::table('request_sales')
            ->join('detail_request_sales', 'request_sales.id_sale', '=', 'detail_request_sales.id_sale')
            ->join('product_inggridients', 'product_inggridients.id_product', '=', 'detail_request_sales.id_product')
            ->select(DB::raw(' request_sales.date_sale ,MONTH(request_sales.date_sale) AS MONTH, YEAR(request_sales.date_sale) AS YEAR, product_inggridients.id_product , product_inggridients.id_inggridient, product_inggridients.usage_amount, SUM(detail_request_sales.qty) * product_inggridients.usage_amount AS total_usage_amount'))
            ->groupByRaw('product_inggridients.id_product, product_inggridients.id_inggridient, MONTH(request_sales.date_sale), YEAR(request_sales.date_sale)')
            ->get();

        foreach ($getAllSale as $sale) {
            InggridientHistory::updateOrCreate([
                'id_inggridient' => $sale->id_inggridient,
                'date' => Carbon::create(Carbon::create($sale->date_sale)->format('Y'), Carbon::create($sale->date_sale)->format('n'), '01'),
            ])->increment('stock_out', $sale->total_usage_amount);
        }

        $purchase_first = Purchase::select('id_purchase', 'date_purchase')->orderBy('date_purchase', 'ASC')->first();
        $inggridientHistory = InggridientHistory::orderBy('date', 'ASC')->orderBy('id_inggridient', 'ASC')->get();
        $unique_inggridient = InggridientHistory::distinct()->count('id_inggridient');

        foreach ($inggridientHistory as $key_history => $history) {
            if (Carbon::create($purchase_first->date_purchase)->startOfMonth()->format('Y-m-d') == $history->date) {
                $history->stock = 0;
                $history->stock_in = $history->purchase;
                $history->save();

                $history->last_stock = $history->stock_in - $history->stock_out;
                $history->save();
            } else {
                if ($inggridientHistory[$key_history - 1]->id_inggridient = $history->id_inggridient) {
                    $stock = $inggridientHistory[$key_history - $unique_inggridient]->last_stock;
                } else {
                    $stock = 0;
                }

                $history->stock = $stock;
                $history->stock_in = $stock + $history->purchase;
                $history->save();

                $history->last_stock = $history->stock_in - $history->stock_out;
                $history->save();
            }
        }
    }
}
