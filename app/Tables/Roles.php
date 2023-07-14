<?php

namespace App\Tables;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class Roles extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return Gate::allows('role_access');
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Role::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id'])
            ->column('id', sortable: true)
            ->column('title')
            ->column(label: 'actions');


        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}
