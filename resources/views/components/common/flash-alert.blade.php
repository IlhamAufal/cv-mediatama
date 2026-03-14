{{--
    Floating Flash Alert Component
    Menampilkan flash message dari session: success, error, warning, info
    Auto-dismiss setelah beberapa detik + bisa ditutup manual
--}}
<div x-data="flashAlert()" x-init="init()"
    class="fixed top-5 right-5 z-[99999] flex flex-col gap-3 w-full max-w-sm pointer-events-none" aria-live="polite"
    aria-atomic="true">
    <template x-for="(alert, index) in alerts" :key="index">
        <div x-show="alert.visible" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-8 scale-95"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 translate-x-8 scale-95" :class="alert.classes"
            class="pointer-events-auto flex items-start gap-3 rounded-xl border px-4 py-3.5 shadow-lg" role="alert">
            <!-- Icon -->
            <span class="mt-0.5 shrink-0" x-html="alert.icon"></span>

            <!-- Message -->
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium leading-snug" x-text="alert.title"></p>
                <p x-show="alert.message" class="mt-0.5 text-xs opacity-80 leading-snug" x-text="alert.message"></p>
            </div>

            <!-- Progress bar -->
            <div class="absolute bottom-0 left-0 h-[3px] rounded-b-xl transition-all ease-linear"
                :class="alert.progressClass" :style="'width:' + alert.progress + '%'"></div>

            <!-- Close Button -->
            <button @click="dismiss(index)" class="shrink-0 ml-1 opacity-60 hover:opacity-100 transition-opacity"
                aria-label="Tutup">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </template>
</div>

@php
    $flashTypes = [
        'success' => [
            'title' => session('success'),
            'type' => 'success',
        ],
        'error' => [
            'title' => session('error'),
            'type' => 'error',
        ],
        'warning' => [
            'title' => session('warning'),
            'type' => 'warning',
        ],
        'info' => [
            'title' => session('info'),
            'type' => 'info',
        ],
    ];

    $activeFlashes = array_filter($flashTypes, fn($f) => !empty($f['title']));
@endphp

<script>
    function flashAlert() {
        return {
            alerts: [],

            init() {
                const flashes = @json(array_values($activeFlashes));

                const config = {
                    success: {
                        classes: 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/30 dark:border-green-700/50 dark:text-green-300 relative overflow-hidden',
                        progressClass: 'bg-green-400 dark:bg-green-500',
                        icon: `<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
                    },
                    error: {
                        classes: 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/30 dark:border-red-700/50 dark:text-red-300 relative overflow-hidden',
                        progressClass: 'bg-red-400 dark:bg-red-500',
                        icon: `<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
                    },
                    warning: {
                        classes: 'bg-yellow-50 border-yellow-200 text-yellow-800 dark:bg-yellow-900/30 dark:border-yellow-700/50 dark:text-yellow-300 relative overflow-hidden',
                        progressClass: 'bg-yellow-400 dark:bg-yellow-500',
                        icon: `<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>`,
                    },
                    info: {
                        classes: 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/30 dark:border-blue-700/50 dark:text-blue-300 relative overflow-hidden',
                        progressClass: 'bg-blue-400 dark:bg-blue-500',
                        icon: `<svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>`,
                    },
                };

                flashes.forEach((flash, i) => {
                    const c = config[flash.type] || config.info;
                    const duration = 5000; // ms

                    const alert = {
                        title: flash.title,
                        message: flash.message || null,
                        visible: true,
                        progress: 100,
                        classes: c.classes,
                        progressClass: c.progressClass,
                        icon: c.icon,
                    };

                    this.alerts.push(alert);

                    // Animate progress bar
                    const idx = this.alerts.length - 1;
                    const interval = 50;
                    const step = (interval / duration) * 100;

                    const timer = setInterval(() => {
                        if (this.alerts[idx]) {
                            this.alerts[idx].progress -= step;
                            if (this.alerts[idx].progress <= 0) {
                                clearInterval(timer);
                                this.dismiss(idx);
                            }
                        } else {
                            clearInterval(timer);
                        }
                    }, interval);
                });
            },

            dismiss(index) {
                if (this.alerts[index]) {
                    this.alerts[index].visible = false;
                    setTimeout(() => {
                        this.alerts.splice(index, 1);
                    }, 250);
                }
            }
        };
    }
</script>
