<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyRoleRequest;
use App\Models\Role;
use App\Tables\Roles;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('role_access');

        return view('roles.index', [
            'roles' => Roles::class,
        ]);
    }

    public function create()
    {
        $this->authorize('role_create');

        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('role_create');

        $role = Role::create(['title' => $request->title]);

        $role->permissions()->sync($request->permissions);

        Splade::toast('Role created')->autoDismiss(4);

        return back();
    }

    public function edit(Role $role)
    {
        $this->authorize('role_edit');

        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('role_edit');

        $role->update(['title' => $request->title]);

        $role->permissions()->sync($request->permissions);

        Splade::toast('Role updated')->autoDismiss(4);

        return back();
    }

    public function destroy(DestroyRoleRequest $request, Role $role)
    {
        $this->authorize('role_delete');

        $role->delete();

        Splade::toast('Role deleted')->autoDismiss(4);

        return back();
    }
}
