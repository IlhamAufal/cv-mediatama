@extends('layouts.app')
@section('title', 'Riwayat Pengajuan Akses Konten')
@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                Riwayat Pengajuan
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Daftar pengajuan akses konten video Anda.
            </p>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-800">
            <table
                class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-700 dark:divide-gray-800 dark:text-gray-400">
                <thead class="bg-gray-50 dark:bg-gray-800/50">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Judul Konten</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Tanggal Pengajuan</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Status</th>
                        <th scope="col" class="px-4 py-3 font-medium text-gray-900 dark:text-white">Berlaku Sampai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse ($pengajuans as $pengajuan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="whitespace-nowrap px-4 py-3">
                                {{ $pengajuan->konten->title ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                {{ $pengajuan->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if ($pengajuan->status === 'pending')
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">
                                        Menunggu
                                    </span>
                                @elseif ($pengajuan->status === 'approved')
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-500/20 dark:text-green-400">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-500/20 dark:text-red-400">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                @if ($pengajuan->status === 'approved' && $pengajuan->expired_at)
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                Belum ada riwayat pengajuan.
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
@endsection
