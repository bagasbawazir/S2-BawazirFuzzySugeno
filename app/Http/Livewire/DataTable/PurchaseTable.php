<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use App\Models\Purchase;
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

final class PurchaseTable extends PowerGridComponent
{
    use ActionButton;
    use LivewireAlert;

    public string $primaryKey = 'id_purchase';
    public string $sortField = 'id_purchase';

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
     * @return Builder<\App\Models\Purchase>
     */
    public function datasource(): Builder
    {
        return Purchase::with(['suppliers:id_supplier,name_supplier', 'users:id_user,fullname', 'master_inggridients']);
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
            ->addColumn('id_purchase_format', fn (Purchase $model) => 'PU-' . '' . str_pad('' . $model->id_purchase, 5, '0', STR_PAD_LEFT))
            ->addColumn('name_supplier', fn (Purchase $model) => $model->suppliers->name_supplier)
            ->addColumn('name_user', fn (Purchase $model) => $model->users->fullname)
            ->addColumn('total_price_inggridient_formated', fn (Purchase $model) => format_uang($model->master_inggridients->sum('pivot.total_price_inggridient')))
            ->addColumn('date_purchase_formatted', fn (Purchase $model) => Carbon::parse($model->date_purchase)->format('l, d F Y'))
            ->addColumn('created_at_formatted', fn (Purchase $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Purchase $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'))
            ->addColumn('total_price_inggridient', fn (Purchase $model) => $model->master_inggridients->sum('pivot.total_price_inggridient'));
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
            Column::make('ID PURCHASE', 'id_purchase_format'),

            Column::make('NAME SUPPLIER', 'name_supplier')
                ->searchable()
                ->sortable(),

            Column::make('NAME USER', 'name_user')
                ->searchable()
                ->sortable(),

            Column::make('TOTAL PRICE PURCHASE', 'total_price_inggridient_formated', 'total_price_inggridient')
                ->searchable()
                ->sortable()
                ->withSum('', false, true),

            Column::make('DATE PURCHASE', 'date_purchase_formatted', 'date_purchase')
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
     * PowerGrid Purchase Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('btn btn-sm btn-info fas fa-eye')
                ->route('purchase.show', ['purchase' => 'id_purchase'])
                ->can(auth()->User()->hasPermissionTo('purchases_show'))
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
     * PowerGrid Purchase Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($purchase) => $purchase->id === 1)
                ->hide(),
        ];
    }
    */
}
