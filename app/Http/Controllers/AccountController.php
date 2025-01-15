<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('account.index', compact('users'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('account.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('account.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('account.index')->with('success', 'User deleted successfully');
    }

    public function view()
    {
        return view('account.view', ['user' => Auth::user()]);
    }
}
