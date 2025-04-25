<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;

class LogExportController extends Controller
{
    
public function export(): StreamedResponse
{
    $fileName = 'logs-'.now()->format('Y-m-d').'.csv';
    $logs = Activity::all();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ];

    return response()->stream(function() use ($logs) {
        $handle = fopen('php://output', 'w');
        
        // CSV Header
        fputcsv($handle, [
            'Timestamp', 'Description', 'Event', 
            'Causer Email', 'Subject Email', 'Properties'
        ]);

        // CSV Rows
        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->created_at,
                $log->description,
                $log->event,
                $log->causer->email ?? 'System',
                $log->subject->email ?? 'N/A',
                json_encode($log->properties)
            ]);
        }
        
        fclose($handle);
    }, 200, $headers);
}
}
