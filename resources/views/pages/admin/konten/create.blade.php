@extends('layouts.app')
@section('title', 'Tambah Konten')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">
                    Tambah Konten Baru
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Silakan isi form di bawah ini untuk menambahkan konten video baru.
                </p>
            </div>
            <div>
                <a href="{{ route('konten.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>

        <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Judul
                        Konten</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="Masukkan judul konten video" required>
                    @error('title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        placeholder="Masukkan deskripsi konten video">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Upload -->
                <div>
                    <label for="file_path" class="block text-sm font-medium text-gray-700 dark:text-gray-400">File
                        Video</label>
                    <div class="mt-1 flex items-center justify-center w-full">
                        <label for="file_path"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('file_path') border-red-500 @enderror">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <i class="fa-solid fa-cloud-arrow-up text-3xl mb-3 text-gray-500 dark:text-gray-400"></i>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik
                                        untuk upload</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">MP4, WEBM, MKV (Max. 100MB)</p>
                            </div>
                            <input id="file_path" name="file_path" type="file" class="hidden" accept="video/*" />
                        </label>
                    </div>
                    <p id="file-name" class="mt-2 text-sm text-gray-500 dark:text-gray-400 hidden"></p>
                    @error('file_path')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="reset"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                        Reset
                    </button>
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 dark:hover:bg-blue-500 transition">
                        Simpan Konten
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.getElementById('file_path').addEventListener('change', function(e) {
                var fileName = e.target.files[0].name;
                var fileInfo = document.getElementById('file-name');
                fileInfo.textContent = 'File terpilih: ' + fileName;
                fileInfo.classList.remove('hidden');
            });
        </script>
    @endpush
@endsection
