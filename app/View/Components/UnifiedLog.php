<?php
// app/View/Components/UnifiedLog.php
namespace App\View\Components;

use Illuminate\View\Component;
use Spatie\Activitylog\Models\Activity;

class UnifiedLog extends Component
{
    public $logs;
    public $userId;

    public function __construct($logs = null, $userId = null)
    {
        $this->logs = $logs;
        $this->userId = $userId;
    }

    public function render()
    {
        if ($this->userId) {
            $this->logs = Activity::where('subject_id', $this->userId)
                ->orWhere('causer_id', $this->userId)
                ->latest()
                ->paginate(10);
        }

        return view('components.unified-log');
    }
}