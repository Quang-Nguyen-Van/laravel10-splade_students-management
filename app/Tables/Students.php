<?php

namespace App\Tables;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Students extends AbstractTable
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
        return Gate::allows('student_access');
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Student::query();
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
            ->withGlobalSearch(columns: ['id', 'name', 'email', 'phone_number'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('email', sortable: true)
            ->column('phone_number')
            ->column(label: 'avatar', exportAs: false)
            ->column('class.name')
            ->column('section.name')
            ->column(label: 'actions', exportAs: false)
            ->export()
            ->selectFilter(
                key: 'class_id',
                options: Classes::pluck('name', 'id')->toArray(),
                label: 'Filter By Class',
                noFilterOption: true,
                noFilterOptionLabel: 'All Classes'
            )
            ->bulkAction(
                label: 'Delete selected students',
                each: fn (Student $student) => $student->delete(),
                confirm: 'Are you sure you want to delete the selected students?',
                // confirmText: 'Are you sure you want to delete the selected students?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Students deleted successfully')->autoDismiss(5)
            )
            ->paginate(5);

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}
