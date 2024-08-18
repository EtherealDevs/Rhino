<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(User $users)
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create($request->all());

        return redirect()->route('admin.users.edit', $user)->with('info', 'user');
    }


    public function show(User $user)
    {
        return view('admin.users.show', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array|exists:roles,id',
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)
            ->with('info', 'Roles actualizados correctamente');
    }



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index', $user)->with('info', 'El Usuario se Elimino con exito');
    }
}
