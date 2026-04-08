<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.admin.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->back()->with('error', 'Admin tidak bisa mengubah role user.');
        }

        $request->validate([
            'role' => 'required|in:superadmin,admin,editor,user',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('dashboard.admin')->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role === 'admin') {
            return redirect()->back()->with('error', 'Admin tidak bisa menghapus user.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('dashboard.admin')->with('error', 'Kamu tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return redirect()->route('dashboard.admin')->with('success', 'User berhasil dihapus!');
    }
}
