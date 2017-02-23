<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TurbolinksRequest;
use App\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate();

        return view('admin.roles.index', compact('roles'));
    }

    public function show(Role $role)
    {
        
    }

    public function create()
    {
        $route = 'roles.store';
        $action = 'Crear';
        $permissions = Permission::all();

        return view('admin.roles.create', compact('route', 'action', 'permissions'));
    }

    public function store(TurbolinksRequest $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:255|unique:roles',
            'label'    => 'required|max:255',
        ]);

        Role::create($request->only(['name', 'label']))
            ->givePermissionTo(
                Permission::whereIn('id', $request->permissions)->pluck('name')
            );

        return redirect('/roles')->with('_turbolinks_location', '/roles');   
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    public function update(TurbolinksRequest $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|max:255|unique:roles,name,' . $role->id,
            'label' => 'sometimes|required|max:255',
        ]);

        $role->fill($request->only(['name', 'label']))->save();
        $role->syncPermissions(
            Permission::whereIn('id', $request->permissions)->pluck('name')
        );

        return redirect('/roles')->with('_turbolinks_location', '/roles');
    }

    public function delete()
    {

    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect('/roles')->with('_turbolinks_location', '/roles');
    }
}
