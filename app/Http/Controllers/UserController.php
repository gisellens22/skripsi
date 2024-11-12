<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch the search query
        $search = $request->input('search');

        // Fetch users with optional search functionality
        $users = User::with('role')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('username', 'like', "%{$search}%");
            })
            ->get();

        return view('users.index', compact('users', 'search'));
    }

    /**
     * Menampilkan form untuk menambah user baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();  // Mengambil semua role
        return view('users.create', compact('roles'));
    }

    /**
     * Menyimpan data user baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'username' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|exists:roles,id',
    ]);

    try {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = $request->input('password');  // Password disimpan langsung tanpa hashing
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to create user.');
    }
}


    /**
     * Menampilkan form untuk mengedit user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();  // Mengambil semua role
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Mengupdate data user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'role_id' => 'required|exists:roles,id',
    ]);

    try {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        
        // Cek jika password diisi, update password tanpa hashing
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->password = $request->input('password');  // Password disimpan langsung tanpa hashing
        }

        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update user.');
    }
}


    /**
     * Menghapus user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Log::info('User deleted successfully: ', ['user_id' => $user->id]);

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}
