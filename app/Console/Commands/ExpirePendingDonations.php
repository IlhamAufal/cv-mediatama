<?php

namespace App\Console\Commands;

use App\Models\Donation;
use Illuminate\Console\Command;

class ExpirePendingDonations extends Command
{
    protected $signature = 'donations:expire';

    protected $description = 'Tandai donasi pending yang sudah melewati expired_at menjadi expired';

    public function handle(): int
    {
        $count = Donation::expiredPending()
            ->update(['status' => Donation::STATUS_EXPIRED]);

        $this->info("[donations:expire] {$count} donasi ditandai expired.");

        return Command::SUCCESS;
    }
}
