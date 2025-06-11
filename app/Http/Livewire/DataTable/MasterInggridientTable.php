<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Models\MasterInggridient;
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

final class MasterInggridientTable extends PowerGridComponent
{
    use ActionButton;
    use LivewireAlert;

    public string $primaryKey = 'id_inggridient';
    public string $sortField = 'id_inggridient';

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
     * @return Builder<\App\Models\MasterInggridient>
     */
    public function datasource(): Builder
    {
        return MasterInggridient::query();
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
            ->addColumn('id_inggridient_format', fn (MasterInggridient $model) => 'B-' . '' . str_pad('' . $model->id_inggridient, 5, '0', STR_PAD_LEFT))
            ->addColumn('name_inggridient')

            /** Example of custom column using a closure **/
            ->addColumn('name_inggridient_lower', fn (MasterInggridient $model) => mb_strtolower(e($model->name_inggridient)))

            ->addColumn('qty_inggridient')
            ->addColumn('unit_inggridient')
            ->addColumn('price_inggridient', fn (MasterInggridient $model) => format_uang($model->price_inggridient))
            ->addColumn('duration_expired')
            ->addColumn('time_expired')
            ->addColumn('updated_at_formatted', fn (MasterInggridient $model) => Carbon::parse($model->updated_at)->format('l, d F Y'));
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
            Column::make('ID INGGRIDIENT', 'id_inggridient_format'),

            Column::make('NAME INGGRIDIENT', 'name_inggridient')
                ->sortable()
                ->searchable(),

            Column::make('UNIT INGGRIDIENT', 'unit_inggridient')
                ->sortable()
                ->searchable(),

            Column::make('PRICE INGGRIDIENT', 'price_inggridient')
                ->searchable()
                ->sortable(),

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
     * PowerGrid MasterInggridient Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            // Button::make('show', 'Show')
            //     ->class('btn btn-sm btn-info fas fa-eye')
            //     ->route('master_inggridient.show', ['master_inggridient' => 'id_inggridient'])
            //     ->can(auth()->User()->hasPermissionTo('master_inggridients_show'))
            //     ->target('_self'),

            Button::make('edit', 'Edit')
                ->class('btn btn-sm btn-warning fas fa-edit')
                ->route('master_inggridient.edit', ['master_inggridient' => 'id_inggridient'])
                ->can(auth()->User()->hasPermissionTo('master_inggridients_edit'))
                ->target('_self'),

            Button::add('destroy')
                ->caption('Delete')
                ->class('btn btn-sm btn-danger fas fa-trash-alt')
                ->emit('delete-data', ['master_inggridient' => 'id_inggridient'])
                ->can(auth()->User()->hasPermissionTo('master_inggridients_delete')),
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
     * PowerGrid MasterInggridient Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($master-inggridient) => $master-inggridient->id === 1)
                ->hide(),
        ];
    }
    */

    public function deleteData(MasterInggridient $master_inggridient): void
    {
        abort_if(Gate::denies('master_inggridients_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->confirm('Delete Data!!', [
            'inputAttributes' => [
                'value' => $master_inggridient,
            ],
            'position' => 'center',
            'timer' => '',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed-alert',
            'showCancelButton' => true,
            'onDismissed' => '',
            'text' => 'Are you sure you want to delete data ' . 'B-' . '' . str_pad('' . $master_inggridient->id_inggridient, 5, '0', STR_PAD_LEFT) . ' ?',
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
        ]);
    }

    public function confirmed($response): void
    {
        $id = $response['data']['inputAttributes']['value']['id_inggridient'];
        $master_inggridient = MasterInggridient::find($id);

        try {
            $master_inggridient->delete();
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
