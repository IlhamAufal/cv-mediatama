@extends('layouts.app')
@section('title', 'Daftar Konten')

@section('content')
<div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
            Daftar Konten
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Pilih konten video dan ajukan akses untuk menontonnya.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($kontens as $konten)
            @php
                $pengajuan = $pengajuanMap[$konten->id] ?? null;
            @endphp

            <div class="flex flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:shadow-md transition dark:border-gray-800 dark:bg-gray-900">


                {{-- Thumbnail --}}
                <div class="mt-3 h-40 overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
                    @if ($konten->file_path)
                        <video class="w-full h-full object-cover" muted>
                            <source src="{{ asset('storage/' . $konten->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div class="flex h-full items-center justify-center">
                            <p class="text-gray-500 dark:text-gray-400">Thumbnail tidak tersedia</p>
                        </div>
                    @endif
                </div>

                {{-- Judul --}}
                <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $konten->title }}
                </h3>


                {{-- Deskripsi --}}
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-3 flex-grow">
                    {{ Str::limit($konten->description, 120) }}
                </p>

                {{-- Divider --}}
                <div class="border-t border-gray-200 dark:border-gray-800 my-4"></div>

                {{-- Aksi --}}
                <div class="flex justify-between items-center">

                    @if ($pengajuan && $pengajuan->status === 'pending')

                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">
                            <i class="fa-solid fa-clock mr-1"></i>
                            Menunggu Persetujuan
                        </span>

                    @elseif ($pengajuan && $pengajuan->isValid())

                        <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800 dark:bg-green-500/20 dark:text-green-400">
                            <i class="fa-solid fa-check mr-1"></i>
                            Akses Aktif
                        </span>
                        <a href="{{ route('customer.konten.show', $konten->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            <i class="fa-solid fa-eye mr-1"></i> Lihat video
                        </a>

                    @else

                        <form action="{{ route('customer.pengajuan.store', $konten->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-2 text-xs font-medium text-white hover:bg-blue-700 transition">
                                <i class="fa-solid fa-paper-plane"></i>
                                Ajukan Akses
                            </button>
                        </form>

                    @endif

                </div>
            </div>

        @empty

            <div class="col-span-full text-center py-10 text-gray-500 dark:text-gray-400">
                Belum ada konten yang tersedia.
            </div>

        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($kontens->hasPages())
        <div class="mt-6">
            {{ $kontens->links() }}
        </div>
    @endif

</div>
@endsection