<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Monitoring & index semua user (superadmin).
     */
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($q_builder) use ($q) {
                $q_builder->where('name', 'like', "%{$q}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest('created_at')->paginate(10)->withQueryString();

        return view('pages.admin.master.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Form create user.
     */
    public function create()
    {
        return view('pages.admin.master.users.create', [
            'title' => 'Tambah User',
            'user' => null,
        ]);
    }

    /**
     * Store user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(UserService::storeRules(), UserService::messages());

        $validated['password']  = Hash::make($validated['password']);
        $validated['is_active'] = true;

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view('pages.admin.master.users.edit', compact('user'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate(UserService::updateRules($user), UserService::messages());

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // is_active dari checkbox — jika tidak tercentang maka false
        $validated['is_active']      = $request->boolean('is_active');
        $validated['deactivated_at'] = $validated['is_active'] ? null : now();

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function show(User $user)
    {
        return view('pages.admin.master.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
}
}