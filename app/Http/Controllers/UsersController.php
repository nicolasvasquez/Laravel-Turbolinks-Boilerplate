<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TurbolinksRequest;
use App\User;
use App\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate();

        return view('admin.users.index', compact('users'));
    }

    public function show()
    {

    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(TurbolinksRequest $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'roles'    => 'present|array',
            'roles.*'  => 'exists:roles,name'
        ]);

        $user = User::create($request->all())->syncRoles($request->roles);

        return redirect('/users')->with('_turbolinks_location', '/users');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(TurbolinksRequest $request, User $user)
    {
        $this->validate($request, [
            'name'     => 'sometimes|required|max:255',
            'email'    => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|confirmed|min:6',
            'roles.*'  => 'exists:roles,name'
        ]);

        $user->fill($request->all())->save();
        $user->syncRoles($request->roles);

        return redirect('/users')->with('_turbolinks_location', '/users');
    }

    public function delete()
    {

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users')->with('_turbolinks_location', '/users');
    }

}
