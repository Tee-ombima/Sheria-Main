<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use Carbon\Carbon;
class ArchiveExpiredListings extends Command
{
    protected $signature = 'listings:archive-expired';

    protected $description = 'Archive listings whose deadline has passed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        $expiredListings = Listing::where('deadline', '<=', $now)
            ->where('archived', false)
            ->get();

        foreach ($expiredListings as $listing) {
            $listing->update(['archived' => true]);
            $this->info("Archived Listing ID: {$listing->id} - Title: {$listing->title}");
        }

        $this->info('Expired listings archived successfully.');
    }
}
