<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permissions.index', [
            'permissions' => Permissions::class,
        ]);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated());

        Splade::toast('Role created')->autoDismiss(4);

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        Splade::toast('Permission updated')->autoDismiss(4);

        return back();
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        Splade::toast('Permission deleted')->autoDismiss(4);

        return back();
    }
}
