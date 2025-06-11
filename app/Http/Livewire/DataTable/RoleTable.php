<?php

declare(strict_types=1);

namespace App\Http\Livewire\DataTable;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
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

final class RoleTable extends PowerGridComponent
{
    use ActionButton;
    use LivewireAlert;

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
     * @return Builder<\Spatie\Permission\Models\Role>
     */
    public function datasource(): Builder
    {
        return Role::query();
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
            ->addColumn('id_format', fn (Role $model) => 'ROLE-' . '' . str_pad('' . $model->id, 3, '0', STR_PAD_LEFT))
            ->addColumn('name')
            ->addColumn('created_at_formatted', fn (Role $model) => Carbon::parse($model->created_at)->format('l d-F-Y'));
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
            Column::make('ID', 'id_format'),

            Column::make('NAME ROLE', 'name')
                ->searchable()
                ->sortable(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
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
     * PowerGrid Role Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::make('show', 'Show')
                ->class('btn btn-sm btn-info fas fa-eye')
                ->route('role.show', ['role' => 'id'])
                ->can(auth()->User()->hasPermissionTo('roles_show'))
                ->target('_self'),

            Button::make('edit', 'Edit')
                ->class('btn btn-sm btn-warning fas fa-edit')
                ->route('role.edit', ['role' => 'id'])
                ->can(auth()->User()->hasPermissionTo('roles_edit'))
                ->target('_self'),

            Button::add('destroy')
                ->caption('Delete')
                ->class('btn btn-sm btn-danger fas fa-trash-alt')
                ->emit('delete-data', ['role' => 'id'])
                ->can(auth()->User()->hasPermissionTo('roles_delete')),
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
     * PowerGrid Role Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($role) => $role->id === 1)
                ->hide(),
        ];
    }
    */

    public function deleteData(Role $role): void
    {
        abort_if(Gate::denies('roles_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->confirm('Delete Data!!', [
            'inputAttributes' => [
                'value' => $role,
            ],
            'position' => 'center',
            'timer' => '',
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed-alert',
            'showCancelButton' => true,
            'onDismissed' => '',
            'text' => 'Are you sure you want to delete data ' . 'ROLE-' . '' . str_pad('' . $role->id, 3, '0', STR_PAD_LEFT) . ' ?',
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
        ]);
    }

    public function confirmed($response): void
    {
        $id = $response['data']['inputAttributes']['value']['id'];
        $role = Role::find($id);

        try {
            $role->delete();
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
