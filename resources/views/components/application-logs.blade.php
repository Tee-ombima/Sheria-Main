<div class="activity-log">
    @foreach($logs as $log)
        <div class="log-entry">
            <div class="log-header">
                <span class="badge">{{ $log->created_at->diffForHumans() }}</span>
                <strong>{{ $log->description }}</strong>
                by {{ $log->causer->email ?? 'System' }}
            </div>
            <div class="log-properties">
                @foreach($log->properties as $key => $value)
                    @if(is_array($value))
                        <div><strong>{{ $key }}:</strong> {{ implode(', ', $value) }}</div>
                    @else
                        <div><strong>{{ $key }}:</strong> {{ $value }}</div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>