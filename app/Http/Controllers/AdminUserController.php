<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('administrator.home', compact('users'));
    }

    public function create()
    {
        return view('administrator.create');
    }

    public function store(Request $request)
    {
        // Validasi input pengguna
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'jabatan' => 'required',
            'level' => 'required',
        ]);

        // Buat pengguna baru
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->jabatan = $request->input('jabatan');
        $user->level = $request->input('level');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil dibuat.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('administrator.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'jabatan' => 'required|string|max:255',
            'level' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
    public function detail($id)
    {
        $user = User::find($id);
        return view('administrator.detail', compact('user'));
    }
}
