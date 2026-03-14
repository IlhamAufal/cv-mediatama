@extends('layouts.app')
@section('title', 'Pengajuan Akses Konten')
@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                    Pengajuan Akses Konten
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Daftar permintaan akses video dari customer.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.pengajuan.index') }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                    Semua
                </a>
                <a href="{{ route('admin.pengajuan.index', ['status' => 'pending']) }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request('status') === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                    Pending
                </a>
                <a href="{{ route('admin.pengajuan.index', ['status' => 'approved']) }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request('status') === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                    Approved
                </a>
                <a href="{{ route('admin.pengajuan.index', ['status' => 'rejected']) }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700' }}">
                    Rejected
                </a>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">
            <table
                class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-700 dark:divide-gray-800 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-800/50">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Customer</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Judul Konten</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Tanggal Pengajuan</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Status</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Berlaku Sampai</th>
                        <th scope="col" class="px-4 py-3 text-right font-medium text-gray-900 dark:text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse ($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="whitespace-nowrap px-4 py-3">
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $pengajuan->user->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">{{ $pengajuan->user->email ?? '' }}</p>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $pengajuan->konten->title ?? '-' }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $pengajuan->created_at->format('d M Y, H:i') }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if ($pengajuan->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                        Pending
                                    </span>
                                @elseif ($pengajuan->status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-500/20 dark:text-green-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        Approved
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-500/20 dark:text-red-400">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if ($pengajuan->expired_at)
                                    <span class="{{ $pengajuan->expired_at->isPast() ? 'text-red-500' : 'text-green-600 dark:text-green-400' }}">
                                        {{ $pengajuan->expired_at->format('d M Y, H:i') }}
                                        @if ($pengajuan->expired_at->isPast())
                                            (Kadaluarsa)
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                @if ($pengajuan->status === 'pending')
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button"
                                            onclick="openApproveModal({{ $pengajuan->id }})"
                                            class="inline-flex items-center gap-1 rounded-lg bg-green-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-green-700 transition">
                                            <i class="fa-solid fa-check"></i> Approve
                                        </button>
                                        <form action="{{ route('admin.pengajuan.reject', $pengajuan->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-700 transition">
                                                <i class="fa-solid fa-xmark"></i> Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada pengajuan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengajuans->hasPages())
            <div class="mt-4">
                {{ $pengajuans->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Approve -->
    <div id="approveModal" class="fixed inset-0 hidden overflow-y-auto z-[99999]" aria-labelledby="approve-modal-title"
        role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="absolute inset-0 bg-gray-500/75 backdrop-blur-sm dark:bg-gray-900/80" aria-hidden="true"
                onclick="closeApproveModal()"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:align-middle dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <form id="approveForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 dark:bg-gray-800">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-green-500/20">
                                <i class="fa-solid fa-check text-green-600 dark:text-green-500 text-lg"></i>
                            </div>
                            <div class="mt-3 w-full text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white"
                                    id="approve-modal-title">Approve Pengajuan</h3>
                                <div class="mt-4">
                                    <label for="expired_at"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Berlaku Sampai <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" name="expired_at" id="expired_at" required
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-700 sm:ml-3 sm:w-auto transition-colors">
                            Ya, Approve
                        </button>
                        <button type="button" onclick="closeApproveModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700 transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('approveModal');
            if (modal) document.body.appendChild(modal);
        });

        function openApproveModal(pengajuanId) {
            const modal = document.getElementById('approveModal');
            const form = document.getElementById('approveForm');
            form.action = '/admin/pengajuan/' + pengajuanId + '/approve';
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeApproveModal() {
            const modal = document.getElementById('approveModal');
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endpush
