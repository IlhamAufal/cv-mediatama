@extends('layouts.app')
@section('title', 'Detail User')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                    Detail User
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi lengkap dari pengguna sistem.
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('users.edit', $user->id) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit
                </a>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-800">
            <table class="w-full text-left text-sm text-gray-700 dark:text-gray-400">
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <th scope="row"
                            class="w-1/3 bg-gray-50 px-4 py-3 font-medium text-gray-900 dark:bg-gray-800/50 dark:text-white">
                            Nama Lengkap
                        </th>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <th scope="row"
                            class="w-1/3 bg-gray-50 px-4 py-3 font-medium text-gray-900 dark:bg-gray-800/50 dark:text-white">
                            Email
                        </th>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <th scope="row"
                            class="w-1/3 bg-gray-50 px-4 py-3 font-medium text-gray-900 dark:bg-gray-800/50 dark:text-white">
                            Role
                        </th>
                        <td class="px-4 py-3">
                            <span
                                class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-400' : 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <th scope="row"
                            class="w-1/3 bg-gray-50 px-4 py-3 font-medium text-gray-900 dark:bg-gray-800/50 dark:text-white">
                            Dibuat Pada
                        </th>
                        <td class="px-4 py-3">{{ $user->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <th scope="row"
                            class="w-1/3 bg-gray-50 px-4 py-3 font-medium text-gray-900 dark:bg-gray-800/50 dark:text-white">
                            Terakhir Diperbarui
                        </th>
                        <td class="px-4 py-3">{{ $user->updated_at->format('d M Y, H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
