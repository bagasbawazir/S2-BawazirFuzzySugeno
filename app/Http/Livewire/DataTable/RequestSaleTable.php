<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use App\Models\RequestSale;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGridRules\Rule;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGridRules\RuleActions;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class RequestSaleTable extends PowerGridComponent
{
    use ActionButton;
    use LivewireAlert;

    public string $primaryKey = 'id_sale';
    public string $sortField = 'id_sale';

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
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

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\RequestSale>
     */
    public function datasource(): Builder
    {
        return RequestSale::with(['users:id_user,fullname', 'master_products']);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id_sale_format', fn (RequestSale $model) => 'SA-' . '' . str_pad('' . $model->id_sale, 5, '0', STR_PAD_LEFT))
            ->addColumn('id_user', fn (RequestSale $model) => $model->users->fullname)
            ->addColumn('qty_sale')
            ->addColumn('total_price_product_formated', fn (RequestSale $model) => format_uang($model->master_products->sum('pivot.total_price_product')))
            ->addColumn('date_sale_formatted', fn (RequestSale $model) => Carbon::parse($model->date_sale)->format('l, d F Y'))
            ->addColumn('created_at_formatted', fn (RequestSale $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (RequestSale $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ->addColumn('total_price_product', fn (RequestSale $model) => $model->master_products->sum('pivot.total_price_product'));
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
            Column::make('ID SALE', 'id_sale_format')
                ->searchable()
                ->sortable(),

            Column::make('ID USER', 'id_user')
                ->searchable()
                ->sortable(),

            Column::make('QTY SALE', 'qty_sale')
                ->searchable()
                ->sortable(),

            Column::make('TOTAL PRICE SALE', 'total_price_product_formated', 'total_price_product')
                ->searchable()
                ->sortable()
                ->withSum('', false, true),

            Column::make('DATE SALE', 'date_sale_formatted', 'date_sale')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid RequestSale Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('btn btn-sm btn-info fas fa-eye')
                ->route('sale.show', ['request_sale' => 'id_sale'])
                ->can(auth()->User()->hasPermissionTo('request_sales_show'))
                ->target('_self'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid RequestSale Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($request-sale) => $request-sale->id === 1)
                ->hide(),
        ];
    }
    */
}
