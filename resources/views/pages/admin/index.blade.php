@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
        Selamat datang, {{ Auth::user()->name }}!
    </h2>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
        Anda memiliki akses penuh sebagai <strong>Admin</strong>.
    </p>
</div>
@endsection
