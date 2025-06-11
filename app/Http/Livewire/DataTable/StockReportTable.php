<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use App\Models\MasterInggridient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class StockReportTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {

        $stock_report = [];

        $date_start = Carbon::create('2021', '07', '01');
        $date_end = Carbon::create('2021', '08', '31');

        $period = CarbonPeriod::create($date_start, $date_end);

        $master_inggridient = MasterInggridient::get();
        foreach ($master_inggridient as $key => $value) {
            foreach ($period as $date) {
                $stock_report[$value['id_inggridient']][$date->format('Y')][$date->format('n')] = [
                    'month' => $date->format('n'),
                    'year' => $date->format('Y'),
                    'id_inggridient' => $value['id_inggridient'],
                    'name_inggridient' => $value['name_inggridient'],
                    'unit_inggridient' => $value['unit_inggridient'],
                    'stock_in' => 0,
                    'stock_out' => 0,
                    'last_stock' => 0,
                ];
            }
        }


        // Data Query Pembelian Bahan Baku Setiap Bulan
        $stock_in = DB::table('purchases')
            ->join('detail_purchases', 'purchases.id_purchase', '=', 'detail_purchases.id_purchase')
            ->join('master_inggridients', 'master_inggridients.id_inggridient', '=', 'detail_purchases.id_inggridient')
            ->select(DB::raw('MONTH(purchases.date_purchase) AS MONTH, YEAR(purchases.date_purchase) AS YEAR, master_inggridients.id_inggridient, detail_purchases.qty'))
            ->whereRaw('MONTH(purchases.date_purchase) >=' . $date_start->format("n") . ' AND ' . 'YEAR(purchases.date_purchase) >=' . $date_start->format("Y") . '')
            ->whereRaw('MONTH(purchases.date_purchase) <=' . $date_end->format("n") . ' AND ' . 'YEAR(purchases.date_purchase) <=' . $date_end->format("Y") . '')
            ->groupByRaw('master_inggridients.id_inggridient, MONTH(purchases.date_purchase), YEAR(purchases.date_purchase)')
            ->get();

        foreach ($stock_in as $key => $value) {
            $stock_report[$value->id_inggridient][$value->YEAR][$value->MONTH]['stock_in'] += $value->qty;
        }

        // Data Query Penjualan Bahan Baku Setiap Bulan
        $stock_out = DB::table('request_sales')
            ->join('detail_request_sales', 'request_sales.id_sale', '=', 'detail_request_sales.id_sale')
            ->join('product_inggridients', 'product_inggridients.id_product', '=', 'detail_request_sales.id_product')
            ->select(DB::raw('MONTH(request_sales.date_sale) AS MONTH, YEAR(request_sales.date_sale) AS YEAR, product_inggridients.id_product , product_inggridients.id_inggridient, product_inggridients.usage_amount, SUM(detail_request_sales.qty) * product_inggridients.usage_amount AS total_usage_amount'))
            ->whereRaw('MONTH(request_sales.date_sale) >=' . $date_start->format("n") . ' AND ' . 'YEAR(request_sales.date_sale) >=' . $date_start->format("Y") . '')
            ->whereRaw('MONTH(request_sales.date_sale) <=' . $date_end->format("n") . ' AND ' . 'YEAR(request_sales.date_sale) <=' . $date_end->format("Y") . '')
            ->groupByRaw('product_inggridients.id_product, product_inggridients.id_inggridient, MONTH(request_sales.date_sale), YEAR(request_sales.date_sale)')
            ->get();

        foreach ($stock_out as $key => $value) {
            $stock_report[$value->id_inggridient][$value->YEAR][$value->MONTH]['stock_out'] += $value->total_usage_amount;
        }

        foreach ($period as $date) {
            foreach ($stock_report as $key => $value) {
                $stock_report[$key][$date->format('Y')][$date->format('n')]['last_stock'] = $value[$date->format('Y')][$date->format('n')]['stock_in'] - $value[$date->format('Y')][$date->format('n')]['stock_out'];

                if (isset($stock_report[$key][$date->format('Y')][$date->format('n') - 1]) ? true : false) {
                }
            }
        }


        dd($stock_report);

        return collect([
            ['id' => 1, 'name' => 'Name 1', 'price' => 1.58, 'created_at' => now(),],
            ['id' => 2, 'name' => 'Name 2', 'price' => 1.68, 'created_at' => now(),],
            ['id' => 3, 'name' => 'Name 3', 'price' => 1.78, 'created_at' => now(),],
            ['id' => 4, 'name' => 'Name 4', 'price' => 1.88, 'created_at' => now(),],
            ['id' => 5, 'name' => 'Name 5', 'price' => 1.98, 'created_at' => now(),],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('price')
            ->addColumn('created_at_formatted', fn ($entry) => Carbon::parse($entry->created_at)->format('d/m/Y'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |

    */
    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->makeInputText('name')
                ->sortable(),

            Column::make('Price', 'price')
                ->sortable()
                ->makeInputRange('price', '.', ''),

            Column::make('Created', 'created_at_formatted')
                ->makeInputDatePicker('created_at'),
        ];
    }
}
