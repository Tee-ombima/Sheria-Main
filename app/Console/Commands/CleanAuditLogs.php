<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// app/Console/Commands/CleanAuditLogs.php

use Spatie\Activitylog\Models\Activity;

class CleanAuditLogs extends Command
{
    protected $signature = 'logs:clean {--days=30 : Remove logs older than this many days}';
    
    public function handle()
    {
        $cutoff = now()->subDays($this->option('days'));
        $deleted = Activity::where('created_at', '<', $cutoff)->delete();
        
        $this->info("Deleted {$deleted} old log entries.");
        return 0;
    }
}