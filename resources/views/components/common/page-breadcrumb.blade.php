@props([
    'pageTitle' => null,
    'items' => [],
])
{{--
    $items  : array of ['label' => '...', 'url' => '...']
              url bersifat opsional — item terakhir otomatis ditampilkan sebagai teks aktif (tanpa link).
    $pageTitle: shorthand jika hanya perlu satu label di akhir trail.
--}}

@php
    /**
     * Bangun trail breadcrumb:
     * - Jika $items diberikan, gunakan itu.
     * - Jika hanya $pageTitle, buat satu item terakhir dari $pageTitle.
     * - Jika keduanya kosong, tidak ada item tambahan (hanya "Home").
     */
    $trail = !empty($items) ? $items : ($pageTitle ? [['label' => $pageTitle]] : []);
@endphp

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <nav aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-1.5">

            {{-- Home --}}
            <li>
                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    href="{{ url('/') }}">
                    Home
                    <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none">
                        <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>

            {{-- Dynamic trail items --}}
            @foreach ($trail as $i => $item)
                @php $isLast = $i === count($trail) - 1; @endphp
                <li class="flex items-center gap-1.5">
                    @if (!$isLast && !empty($item['url']))
                        <a href="{{ $item['url'] }}"
                            class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            {{ $item['label'] }}
                        </a>
                        <svg class="stroke-current text-gray-400 dark:text-gray-600" width="17" height="16"
                            viewBox="0 0 17 16" fill="none">
                            <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @else
                        <span class="text-sm font-medium text-gray-800 dark:text-white/80">
                            {{ $item['label'] }}
                        </span>
                    @endif
                </li>
            @endforeach

        </ol>
    </nav>
</div>
