@extends('layouts.app')
@section('title', 'Detail Konten')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                    Detail Konten
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Informasi lengkap mengenai konten video.
                </p>
            </div>
            <div>
                <a href="{{ route('customer.konten.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Video Player Column -->
            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl bg-black shadow-lg">
                    @if ($konten->file_path)
                        <video controls class="w-full aspect-video object-cover">
                            <source src="{{ asset('storage/' . $konten->file_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div class="flex aspect-video items-center justify-center bg-gray-100 dark:bg-gray-800">
                            <p class="text-gray-500 dark:text-gray-400">File video tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Details Column -->
            <div class="lg:col-span-1">
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800/50">
                    <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Informasi Video</h3>

                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Judul
                            </label>
                            <p class="mt-1 text-base font-medium text-gray-900 dark:text-white">
                                {{ $konten->title }}
                            </p>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Deskripsi
                            </label>
                            <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300 whitespace-pre-line">
                                {{ $konten->description ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Batas Waktu Akses
                            </label>
                            <p class="mt-1 text-base font-medium {{ $pengajuan && $pengajuan->expired_at && $pengajuan->expired_at->isPast() ? 'text-red-500' : 'text-gray-900 dark:text-white' }}">
                                @if ($pengajuan && $pengajuan->expired_at)
                                    {{ $pengajuan->expired_at->format('d F Y, H:i') }}
                                    @if ($pengajuan->expired_at->isPast())
                                        <span class="text-xs text-red-500">(Kadaluarsa)</span>
                                    @endif
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Re-use Delete Modal from Index or include it separately? -->
    <!-- Ideally, we should have a component, but for now I'll inline it to ensure functionality in show view as well -->
    <div id="deleteModal" class="fixed inset-0 z-[99999] hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity backdrop-blur-sm dark:bg-gray-900/80"
                aria-hidden="true" onclick="closeDeleteModal()"></div>
            <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 dark:bg-gray-800">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 dark:bg-red-500/20">
                            <i class="fa-solid fa-triangle-exclamation text-red-600 dark:text-red-500 text-lg"></i>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">Hapus
                                Konten</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus konten
                                    video ini? Tindakan ini tidak dapat dibatalkan.</p>
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
                            class="inline-flex w-full justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">Ya,
                            Hapus</button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()"
                        class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700 transition-colors">Batal</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
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
@endsection
