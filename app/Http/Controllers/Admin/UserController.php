<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employeee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    public function index()
    {

        $response['users'] = User::orderByDesc('id')->get();

        return view('admin.user.list.index', $response);
    }

    public function create()
    {
        $response['employees'] = Employeee::all();

        return view('admin.user.create.index', $response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'employee_id' => 'nullable|exists:employeees,id',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        if ($request->employee_id) {
            $employee = Employeee::find($request->employee_id);
            $user->name = $employee->name;
            $user->email = $employee->email;
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
        }
        $user->employee_id = $request->employee_id;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Utilizador criado com sucesso!');
    }

    public function show($id)
    {

        $response['user'] = User::findOrFail($id);

        return view('admin.user.details.index', $response);
    }

    public function edit($id)
    {
        $response['user'] = User::findOrFail($id);
        $response['employees'] = Employeee::all();

        return view('admin.user.edit.index', $response);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'employee_id' => 'nullable|exists:employeees,id',
            'role' => 'required|string',
            /* 'password' => 'nullable|string|min:6', */
        ]);

        $user = User::findOrFail($id);
        if ($request->employee_id) {
            $employee = Employeee::find($request->employee_id);
            $user->name = $employee->name;
            $user->email = $employee->email;
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
        }
        $user->employee_id = $request->employee_id;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.user.list.index')->with('success', 'Utilizador atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.list.index')->with('success', 'Deletado com sucesso!');
    }
}
