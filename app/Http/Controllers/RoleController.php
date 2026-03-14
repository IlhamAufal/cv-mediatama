<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Daftar semua role beserta jumlah user.
     */
    public function index()
    {
        $roles = Role::withCount('users')->latest()->get();

        return view('pages.master.roles.index', [
            'title' => 'Manajemen Role',
            'roles' => $roles,
        ]);
    }

    /**
     * Form tambah role baru.
     */
    public function create()
    {
        return view('pages.master.roles.form', [
            'title' => 'Tambah Role',
            'role'  => null,
        ]);
    }

    /**
     * Simpan role baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'color'       => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $validated['slug']         = Str::slug($validated['name']);
        $validated['is_protected'] = false;

        // Pastikan slug unik
        if (Role::where('slug', $validated['slug'])->exists()) {
            return back()->withInput()
                ->withErrors(['name' => 'Nama role ini sudah digunakan (slug duplikat).']);
        }

        Role::create($validated);

        return redirect()->route('roles.index')
            ->with('success', "Role \"{$validated['name']}\" berhasil ditambahkan.");
    }

    /**
     * Form edit role.
     */
    public function edit(Role $role)
    {
        return view('pages.master.roles.form', [
            'title' => 'Edit Role',
            'role'  => $role,
        ]);
    }

    /**
     * Update role.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'color'       => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        // Role is_protected: nama dan slug tidak boleh diubah (hanya deskripsi & warna)
        if ($role->is_protected) {
            $role->update([
                'description' => $validated['description'],
                'color'       => $validated['color'],
            ]);
        } else {
            $newSlug = Str::slug($validated['name']);

            // Cek slug unik (kecuali role ini sendiri)
            if (Role::where('slug', $newSlug)->where('id', '!=', $role->id)->exists()) {
                return back()->withInput()
                    ->withErrors(['name' => 'Nama role ini sudah digunakan (slug duplikat).']);
            }

            $role->update([
                'name'        => $validated['name'],
                'slug'        => $newSlug,
                'description' => $validated['description'],
                'color'       => $validated['color'],
            ]);
        }

        return redirect()->route('roles.index')
            ->with('success', "Role \"{$role->name}\" berhasil diperbarui.");
    }

    /**
     * Hapus role — role is_protected tidak bisa dihapus.
     */
    public function destroy(Role $role)
    {
        if ($role->is_protected) {
            return redirect()->route('roles.index')
                ->with('error', "Role \"{$role->name}\" adalah role sistem dan tidak dapat dihapus.");
        }

        if ($role->users()->exists()) {
            return redirect()->route('roles.index')
                ->with('error', "Role \"{$role->name}\" masih memiliki user aktif dan tidak dapat dihapus.");
        }

        $name = $role->name;
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', "Role \"{$name}\" berhasil dihapus.");
    }
}

