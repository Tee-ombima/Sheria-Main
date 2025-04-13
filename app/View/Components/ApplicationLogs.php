<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Spatie\Activitylog\Models\Activity;

class ApplicationLogs extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $logs = Activity::where('log_name', 'application')
            ->latest()
            ->paginate(10);
            
        return view('components.application-logs', compact('logs'));
    }
}
