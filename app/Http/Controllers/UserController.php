<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ Tampilkan semua user dengan pencarian dan pagination
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('username', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['search' => $search]); // agar pagination tetap membawa parameter search

        return view('users.index', compact('users', 'search'));
    }

    // ✅ Form tambah user
    public function create()
    {
        return view('users.create');
    }

    // ✅ Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:users,email',
            'no_telepon' => 'nullable|string|max:20',
            'role' => 'required|in:PIC,PETUGAS,KEPALA_KANTOR',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // ✅ Form edit user
    public function edit(User $user)
    {
        return view('users.create', compact('user'));
    }

    // ✅ Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->user_id . ',user_id',
            'password' => 'nullable|min:6',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'no_telepon' => 'nullable|string|max:20',
            'role' => 'required|in:PIC,PETUGAS,KEPALA_KANTOR',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $data = $request->only([
            'username',
            'nama_lengkap',
            'email',
            'no_telepon',
            'role',
            'status'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // ✅ Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
