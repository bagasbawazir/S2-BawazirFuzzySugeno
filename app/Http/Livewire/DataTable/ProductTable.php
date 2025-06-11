<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Exception;
use App\Models\MasterProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
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

final class ProductTable extends PowerGridComponent
{
    use ActionButton;
    use LivewireAlert;

    public string $primaryKey = 'id_product';
    public string $sortField = 'id_product';

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
     * @return Builder<\App\Models\MasterProduct>
     */
    public function datasource(): Builder
    {
        return MasterProduct::query();
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
            ->addColumn('id_product_format', fn (MasterProduct $model) => 'P-' . '' . str_pad('' . $model->id_product, 5, '0', STR_PAD_LEFT))
            ->addColumn('name_product')

            /** Example of custom column using a closure **/
            ->addColumn('name_product_lower', fn (MasterProduct $model) => mb_strtolower(e($model->name_product)))

            ->addColumn('unit_product')
            ->addColumn('price_product_format', fn (MasterProduct $model) => format_uang($model->price_product))
            ->addColumn('updated_at_formatted', fn (MasterProduct $model) => Carbon::parse($model->updated_at)->format('l, d F Y'));
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
            Column::make('ID PRODUCT', 'id_product_format'),

            Column::make('NAME PRODUCT', 'name_product')
                ->sortable()
                ->searchable(),

            Column::make('UNIT PRODUCT', 'unit_product')
                ->sortable()
                ->searchable(),

            Column::make('PRICE PRODUCT', 'price_product_format', 'price_product'),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable(),

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
     * PowerGrid MasterProduct Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('btn btn-sm btn-info fas fa-eye')
                ->route('master_product.show', ['master_product' => 'id_product'])
                ->can(auth()->User()->hasPermissionTo('master_products_show'))
                ->target('_self'),

            Button::make('edit', 'Edit')
                ->class('btn btn-sm btn-warning fas fa-edit')
                ->route('master_product.edit', ['master_product' => 'id_product'])
                ->can(auth()->User()->hasPermissionTo('master_products_edit'))
                ->target('_self'),

            Button::add('destroy')
                ->caption('Delete')
                ->class('btn btn-sm btn-danger fas fa-trash-alt')
                ->emit('delete-data', ['master_product' => 'id_product'])
                ->can(auth()->User()->hasPermissionTo('master_products_delete')),
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
     * PowerGrid MasterProduct Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($master-product) => $master-product->id === 1)
                ->hide(),
        ];
    }
    */

    public function deleteData(MasterProduct $master_product): void
    {
        abort_if(Gate::denies('master_products_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->confirm('Delete Data!!', [
            'inputAttributes' => [
                'value' => $master_product,
            ],
            'position' => 'center',
            'timer' => '',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed-alert',
            'showCancelButton' => true,
            'onDismissed' => '',
            'text' => 'Are you sure you want to delete data ' . 'P-' . '' . str_pad('' . $master_product->id_product, 5, '0', STR_PAD_LEFT) . ' ?',
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
        ]);
    }

    public function confirmed($response): void
    {
        $id = $response['data']['inputAttributes']['value']['id_product'];
        $master_product = MasterProduct::find($id);

        try {
            $master_product->delete();
        } catch (Exception $e) {
            $this->alert('error', 'Failed to Delete Data', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
                'timerProgressBar' => true,
                'text' => 'The data you deleted is being used.',
                'width' => '400',
            ]);
        }
    }

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'delete-data' => 'deleteData',
                'confirmed-alert' => 'confirmed',
            ]
        );
    }
}
