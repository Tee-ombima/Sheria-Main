<?php

namespace App\View\Components;

use Illuminate\View\Component;
// app/View/Components/AuditLog.php
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class AuditLog extends Component
{
    public $logs;
    
    public function __construct($userId = null, $limit = 10)
    {
        $query = Activity::with('causer')
            ->where('subject_type', User::class)
            ->latest();
            
        if ($userId) {
            $query->where('subject_id', $userId);
        }
        
        $this->logs = $query->limit($limit)->get();
    }

    public function render()
    {
        return view('components.audit-log');
    }
}