@extends('layouts.app')
@section('title', 'Customer Dashboard')
@section('content')
<div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="mb-5 flex items-center gap-3">
        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800 dark:bg-green-900/30 dark:text-green-400">
            <svg class="mr-1.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            Login sebagai: Customer
        </span>
    </div>
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
        Selamat datang, {{ Auth::user()->name }}!
    </h2>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
        Anda login sebagai <strong>Customer</strong>. Email: {{ Auth::user()->email }}
    </p>
</div>
@endsection
