<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $role = $user->role;

        $data = ['title' => 'Dashboard', 'user' => $user];

        if ($role === 'admin') {
            return view('pages.admin.index', $data);
        }

        return view('pages.customer.index', $data);
    }
}