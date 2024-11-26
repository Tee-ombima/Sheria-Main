<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use Carbon\Carbon;

class ArchiveExpiredListings extends Command
{
    protected $signature = 'listings:archive-expired';

    protected $description = 'Archive listings whose deadline has passed';

    public function handle()
    {
        $now = Carbon::now();
        $this->info("Current time: " . $now->toDateTimeString());

        $expiredListings = Listing::where('deadline', '<=', $now)
            ->where('archived', false)
            ->get();

        if ($expiredListings->isEmpty()) {
            $this->info('No expired listings found.');
            return;
        }

        foreach ($expiredListings as $listing) {
            $this->info("Archiving Listing ID: {$listing->id} - Deadline: {$listing->deadline->toDateTimeString()}");
            $listing->update(['archived' => true]);
        }

        $this->info('Expired listings archived successfully.');
    }
}
