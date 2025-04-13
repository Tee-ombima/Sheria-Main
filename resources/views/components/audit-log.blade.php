<!-- resources/views/components/audit-log.blade.php -->

<div class="mt-6 space-y-4">
    @foreach($logs as $log)
        <div class="p-4 border rounded-lg">
            <div class="flex justify-between">
                <span class="font-medium">
                    {{ $log->description }}
                </span>
                <span class="text-sm text-gray-500">
                    {{ $log->created_at->diffForHumans() }}
                </span>
            </div>
            
            @if($log->event === 'permissions_updated')
                <div class="mt-2">
                    <p class="text-sm">Changed by: {{ $log->causer->name ?? 'System' }}</p>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div>
                            <p class="text-xs font-medium">Old Permissions:</p>
                            @forelse($log->properties['old'] ?? [] as $permission)
                                <span class="inline-block px-2 py-1 text-xs bg-gray-100 rounded mr-1 mb-1">
                                    {{ $permission }}
                                </span>
                            @empty
                                <span class="text-xs text-gray-500">None</span>
                            @endforelse
                        </div>
                        <div>
                            <p class="text-xs font-medium">New Permissions:</p>
                            @forelse($log->properties['new'] ?? [] as $permission)
                                <span class="inline-block px-2 py-1 text-xs bg-green-100 rounded mr-1 mb-1">
                                    {{ $permission }}
                                </span>
                            @empty
                                <span class="text-xs text-gray-500">None</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>