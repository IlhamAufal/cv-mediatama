<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk membatasi akses berdasarkan role user.
 *
 * Penggunaan di route:
 *   ->middleware('role:superadmin')
 *   ->middleware('role:superadmin,admin')     // superadmin ATAU admin-*
 *   ->middleware('role:member')
 *
 * Kata kunci khusus:
 *   - 'admin' → cocok dengan semua role yang diawali 'admin-' (admin-iman, admin-budaya, dll.)
 *   - role lain dicocokkan persis (exact match).
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Belum login → serahkan ke middleware 'auth' (redirect ke signin)
        if (! $user) {
            return redirect()->route('signin');
        }

        foreach ($roles as $role) {
            if ($this->matchRole($user, trim($role))) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    /**
     * Cek apakah user cocok dengan role yang diminta.
     */
    private function matchRole($user, string $role): bool
    {
        return match ($role) {
            'superadmin' => $user->isSuperadmin(),
            'admin'      => $user->isAdmin(),       // admin-iman, admin-budaya, dll.
            'member'     => $user->isMember(),
            default      => $user->role === $role,   // exact match (misal: 'admin-iman')
        };
    }
}
