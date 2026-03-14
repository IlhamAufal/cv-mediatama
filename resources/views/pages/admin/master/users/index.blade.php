@extends('layouts.app')
@section('title', 'Manajemen Users')
@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                    Manajemen Users
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Berikut adalah daftar pengguna dalam sistem.
                </p>
            </div>
            <div>
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                    <i class="fa-solid fa-plus"></i>
                    Tambah User
                </a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">
            <table
                class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-700 dark:divide-gray-800 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-800/50">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Nama</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Email</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Role</th>
                        <th scope="col" class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="whitespace-nowrap px-4 py-3">{{ $user->name }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $user->email }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-400' : 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('users.show', $user->id) }}" title="Detail"
                                        class="font-medium text-emerald-600 hover:text-emerald-800 dark:text-emerald-500 dark:hover:text-emerald-400">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" title="Edit"
                                        class="font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @if ($user->id === auth()->id())
                                    <button type="button" disabled 
                                        onclick="openDeleteModal('{{ route('users.destroy', $user->id) }}')" title="tidak bisa  mengahpus diri sendiri"
                                        class="font-medium text-gray-600 hover:text-gray-800 dark:text-gray-500 dark:hover:text-gray-400">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @else
                                    <button type="button"
                                        onclick="openDeleteModal('{{ route('users.destroy', $user->id) }}')" title="Hapus"
                                        class="font-medium text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 hidden overflow-y-auto z-[99999]" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="absolute inset-0 bg-gray-500/75 backdrop-blur-sm dark:bg-gray-900/80" aria-hidden="true"
                onclick="closeDeleteModal()"></div>

            <!-- Trick untuk center modal -->
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div
                class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-red-500/20">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 dark:text-red-500 text-lg"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white"
                                id="modal-title">Hapus Pengguna</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus
                                    pengguna ini? </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700 transition-colors">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Teleport modal ke body agar keluar dari stacking context layout
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('deleteModal');
            if (modal) document.body.appendChild(modal);
        });

        function openDeleteModal(url) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = url;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endpush
