<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /**
         * Metadata warna untuk setiap pilar — dipakai di banyak view (community,
         * pillar, volunteer, dll). Di-share sekali di sini agar tidak perlu
         * mendefinisikan ulang array yang sama di setiap blade.
         */
        View::share('pillarMeta', [
            'iman' => [
                'label'    => 'Iman',
                'badge'    => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
                'dot'      => 'bg-emerald-500',
                'gradient' => 'from-emerald-600 to-emerald-800',
                'accent'   => 'emerald',
                'ring'     => 'ring-emerald-500',
                'bg'       => 'bg-emerald-800',
                'icon'     => '<path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>',
            ],
            'budaya' => [
                'label'    => 'Budaya',
                'badge'    => 'bg-orange-100 text-orange-700 dark:bg-orange-500/20 dark:text-orange-400',
                'dot'      => 'bg-orange-500',
                'gradient' => 'from-orange-500 to-orange-800',
                'accent'   => 'orange',
                'ring'     => 'ring-orange-500',
                'bg'       => 'bg-orange-800',
                'icon'     => '<path d="M12 3v10.55A4 4 0 1014 17V7h4V3h-6z"/>',
            ],
            'olahraga' => [
                'label'    => 'Olahraga',
                'badge'    => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400',
                'dot'      => 'bg-blue-500',
                'gradient' => 'from-blue-600 to-blue-900',
                'accent'   => 'blue',
                'ring'     => 'ring-blue-500',
                'bg'       => 'bg-blue-800',
                'icon'     => '<path d="M13.49 5.48c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-3.6 13.9l1-4.4 2.1 2v6h2v-7.5l-2.1-2 .6-3c1.3 1.5 3.3 2.5 5.5 2.5v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.4-.6-1-1-1.7-1-.3 0-.5.1-.8.1l-5.2 2.2v4.7h2v-3.4l1.8-.7-1.6 8.1-4.9-1-.4 2 7 1.4z"/>',
            ],
            'sosial' => [
                'label'    => 'Sosial',
                'badge'    => 'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400',
                'dot'      => 'bg-rose-500',
                'gradient' => 'from-rose-500 to-rose-800',
                'accent'   => 'rose',
                'ring'     => 'ring-rose-500',
                'bg'       => 'bg-rose-800',
                'icon'     => '<path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>',
            ],
        ]);

        /**
         * Konfigurasi badge status untuk VolunteerProfile.
         * Di-share agar monitoring & pengajuan tidak mendefinisikan ulang.
         */
        View::share('volunteerStatusCfg', [
            'pending' => [
                'label' => 'Menunggu Verifikasi',
                'badge' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
                'dot'   => 'bg-amber-400',
                'icon'  => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z',
            ],
            'active' => [
                'label' => 'Relawan Aktif',
                'badge' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
                'dot'   => 'bg-emerald-500',
                'icon'  => 'M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z',
            ],
            'inactive' => [
                'label' => 'Nonaktif',
                'badge' => 'bg-gray-100 text-gray-500 dark:bg-gray-800 dark:text-gray-400',
                'dot'   => 'bg-gray-400',
                'icon'  => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z',
            ],
            'rejected' => [
                'label' => 'Ditolak',
                'badge' => 'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400',
                'dot'   => 'bg-rose-500',
                'icon'  => 'M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z',
            ],
        ]);
    }
}
