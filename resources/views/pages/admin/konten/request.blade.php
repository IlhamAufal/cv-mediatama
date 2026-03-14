@extends('layouts.app')@extends('layouts.app')@extends('layouts.app')

@section('title', 'Permintaan Akses Konten')

@section('title', 'Permintaan Akses Konten')@section('title', 'Manajemen Konten')

@section('content')

    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
    @section('content')
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
            @section('content')
                <div <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                    class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">

                    Permintaan User

                    </h2>
                    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            Daftar permintaan akses atau persetujuan dari user/customer.

                            </p>
                            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                            </div>
                            <div>

                                <div>

                                    <!-- Optional: Filter or search could go here -->
                                    <div>

                                    </div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">

                                </div>

                                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90"> Manajemen Users

                                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">

                                        <table
                                            class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-700 dark:divide-gray-800 dark:text-gray-400">
                                            Permintaan User
                                </h2>

                                <thead class="bg-gray-50 dark:bg-gray-800/50">

                                    <tr>
                                        </h2>

                                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Nama
                                            User</th>

                                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Judul
                                            Konten</th>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                            <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                Tanggal Request</th>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                            <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                Status</th>

                                            <th scope="col"
                                                class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">Aksi
                                            </th> Daftar permintaan akses atau persetujuan dari user/customer. Berikut
                                            adalah daftar pengguna

                                    </tr> dalam sistem.

                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                    </p>

                                    {{-- @forelse ($requests as $request) --}} </p>

                                    <!-- Placeholder for visual purposes -->

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            </div>

                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                        </div>

                        <div class="flex items-center gap-2">

                            <div
                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs uppercase dark:bg-blue-900 dark:text-blue-300">
                                <div>

                                    JD <div>

                                    </div>

                                    John Doe <!-- Optional: Filter or search could go here --> <a
                                        href="{{ route('users.create') }}" </div>

                                </div>
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">

                                </td>

                                <td class="whitespace-nowrap px-4 py-3">Tutorial Laravel Dasar</td>
                            </div> <i class="fa-solid fa-plus"></i>

                            <td class="whitespace-nowrap px-4 py-3">12 Jan 2024</td>

                            <td class="whitespace-nowrap px-4 py-3"> Tambah User

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">
                                        </a>

                                        Pending

                                </span>
                                <table </td>
                                    class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-700 dark:divide-gray-800 dark:text-gray-400">

                                    <td class="whitespace-nowrap px-4 py-3 text-right">
                        </div>

                        <div class="flex items-center justify-end gap-2">

                            <button type="button" title="Setujui" <thead class="bg-gray-50 dark:bg-gray-800/50">

                                class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-emerald-700 transition">
                        </div>

                        <i class="fa-solid fa-check mr-1.5"></i> Terima

                        </button>
                        <tr>

                            <button type="button" title="Tolak"
                                class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-700 transition">
                                <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Nama User
                                </th>

                                <i class="fa-solid fa-xmark mr-1.5"></i> Tolak <div
                                    class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">

                            </button>

                    </div>
                    <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Judul Konten</th>

                    </td>
                    <table <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Tanggal

                        </tr> Request</th>

                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-700 dark:divide-gray-800 dark:text-gray-400">

                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">

                                <div class="flex items-center gap-2">
                            <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Status</th>

                            <div
                                class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-xs uppercase dark:bg-purple-900 dark:text-purple-300">
                                <thead class="bg-gray-50 dark:bg-gray-800/50">

                                    AS

                            </div>
                            <th scope="col" Alice Smith
                                class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">Aksi</th>

                </div>
                <tr>

                    </td>

                    <td class="whitespace-nowrap px-4 py-3">Tips & Trik CSS</td>
                </tr>

                <td class="whitespace-nowrap px-4 py-3">11 Jan 2024</td>
                <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Nama</th>

                <td class="whitespace-nowrap px-4 py-3">

                    <span
                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                        </thead>

                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Email</th>

                Disetujui

                </span>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                    </td>
                    <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Role</th>

                    <td class="whitespace-nowrap px-4 py-3 text-right">

                        <span class="text-xs text-gray-400 italic">Selesai</span> {{-- @forelse ($requests as $request) --}}
                    <th scope="col" </td> class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">Aksi
                    </th>

                    </tr>

                    {{-- @empty                                    <!-- Placeholder Data for UI Visualization (Uncomment loop when backend is ready) -->

                        <tr>                    </tr>

                            <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">

                                Belum ada permintaan baru.                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">

                            </td>                        </thead>

                        </tr>

                    @endforelse --}} <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">

                </tbody>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                    </table>

            </div>
            <div class="flex items-center gap-2">

            </div>
            @foreach ($users as $user)
            @endsection <div
                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs uppercase dark:bg-blue-900 dark:text-blue-300">
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">

                    JD <td class="whitespace-nowrap px-4 py-3">{{ $user->name }}</td>

            </div>
            <td class="whitespace-nowrap px-4 py-3">{{ $user->email }}</td>

            John Doe <td class="whitespace-nowrap px-4 py-3">

    </div> <span </td>
        class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-400' : 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' }}">

        <td class="whitespace-nowrap px-4 py-3">Tutorial Laravel Dasar</td>
        {{ ucfirst($user->role) }}

        <td class="whitespace-nowrap px-4 py-3">12 Jan 2024</td>
    </span>

    <td class="whitespace-nowrap px-4 py-3"> </td>

    <span
        class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
        <td class="whitespace-nowrap px-4 py-3 text-right">

            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            <div class="flex items-center justify-end gap-3">

                Pending <a href="{{ route('users.show', $user->id) }}" title="Detail" </span>
                    class="font-medium text-emerald-600 hover:text-emerald-800 dark:text-emerald-500 dark:hover:text-emerald-400">

        </td> <i class="fa-solid fa-eye"></i>

        <td class="whitespace-nowrap px-4 py-3 text-right"> </a>

            <div class="flex items-center justify-end gap-2"> <a href="{{ route('users.edit', $user->id) }}"
                    title="Edit" <button type="button" title="Setujui"
                    class="font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">

                    class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i>

                    <i class="fa-solid fa-check mr-1.5"></i> Terima </a>

                </button>
                @if ($user->id === auth()->id())
                    <button type="button" title="Tolak" <button type="button" disabled
                        class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-700 transition">
                        onclick="openDeleteModal('{{ route('users.destroy', $user->id) }}')"
                        title="tidak bisa  mengahpus diri sendiri"

                        <i class="fa-solid fa-xmark mr-1.5"></i> Tolak
                        class="font-medium text-gray-600 hover:text-gray-800 dark:text-gray-500 dark:hover:text-gray-400">

                    </button> <i class="fa-solid fa-trash-can"></i>

            </div> </button>

        </td>
    @else
        </tr> <button type="button" <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
            onclick="openDeleteModal('{{ route('users.destroy', $user->id) }}')" title="Hapus"

            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                class="font-medium text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">

                <div class="flex items-center gap-2"> <i class="fa-solid fa-trash-can"></i>

                    <div
                        class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-xs uppercase dark:bg-purple-900 dark:text-purple-300">
        </button>

        AS
        @endif

</div>
</div>

Alice Smith </td>

</div>
</tr>

</td>
@endforeach

<td class="whitespace-nowrap px-4 py-3">Tips & Trik CSS</td>
</tbody>

<td class="whitespace-nowrap px-4 py-3">11 Jan 2024</td>
</table>

<td class="whitespace-nowrap px-4 py-3">
    </div>

    <span
        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
        </div>

        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

        Disetujui <!-- Modal Konfirmasi Hapus -->

    </span>
    <div id="deleteModal" class="fixed inset-0 hidden overflow-y-auto z-[99999]" aria-labelledby="modal-title" </td>
        role="dialog" aria-modal="true">

<td class="whitespace-nowrap px-4 py-3 text-right">
    <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <span class="text-xs text-gray-400 italic">Selesai</span> <!-- Background overlay -->

</td>
<div class="absolute inset-0 bg-gray-500/75 backdrop-blur-sm dark:bg-gray-900/80" aria-hidden="true" </tr>
    onclick="closeDeleteModal()"></div>

{{-- @empty

                        <tr>            <!-- Trick untuk center modal -->

                            <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>

                                Belum ada permintaan baru.

                            </td>            <!-- Modal panel -->

                        </tr>            <div

                    @endforelse --}}
class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

</tbody>
<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800">

    </table>
    <div class="sm:flex sm:items-start">

    </div>
    <div </div>
        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-red-500/20">

    @endsection <i class="fa-solid fa-triangle-exclamation text-red-600 dark:text-red-500 text-lg"></i>

</div>
<div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
    <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">Hapus Pengguna
    </h3>
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
