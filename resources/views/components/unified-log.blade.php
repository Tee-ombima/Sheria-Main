<!-- resources/views/components/unified-log.blade.php -->
<div class="space-y-4">
    @foreach($logs as $log)
        <div class="p-4 border rounded-lg bg-white shadow-sm">
            <!-- Log Header -->
            <div class="flex justify-between items-start mb-2">
                <div>
                    <div class="font-medium text-gray-700">
                        @if($log->description == 'Permissions updated')
                            <i class="fas fa-user-shield mr-2 text-purple-500"></i>
                        @elseif(str_contains($log->description, 'submitted'))
                            <i class="fas fa-file-upload mr-2 text-blue-500"></i>
                        @else
                            <i class="fas fa-history mr-2 text-gray-500"></i>
                        @endif
                        {{ $log->description }}
                    </div>
                    <div class="text-sm text-gray-500">
                        @if($log->causer)
                            <span class="font-medium">{{ $log->causer->email }}</span>
                        @else
                            <span class="text-gray-400">System</span>
                        @endif
                        • {{ $log->created_at->diffForHumans() }}
                    </div>
                </div>
                <span class="badge badge-{{ $log->getExtraProperty('type', 'info') }} text-xs">
                    {{ $log->log_name }}
                </span>
            </div>

            <!-- Log Content -->
            <div class="mt-3 text-sm">
                @if($log->event === 'permissions_updated')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-600">OLD PERMISSIONS:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach($log->properties['old'] ?? [] as $permission)
                                    <span class="inline-block px-2 py-1 text-xs bg-gray-100 rounded">
                                        {{ $permission }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600">NEW PERMISSIONS:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach($log->properties['new'] ?? [] as $permission)
                                    <span class="inline-block px-2 py-1 text-xs bg-green-100 rounded">
                                        {{ $permission }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @elseif(isset($log->properties['entries_count']))
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-database mr-2"></i>
                            Entries: {{ $log->properties['entries_count'] }}
                        </div>
                        @isset($log->properties['entries_sample'])
                        <div class="flex flex-wrap gap-2 text-xs">
                            @foreach($log->properties['entries_sample'] as $sample)
                                <span class="px-2 py-1 bg-blue-50 rounded-full">
                                    {{ $sample['rel_course'] ?? $sample['prof_institution_name'] ?? 'Entry' }}
                                </span>
                            @endforeach
                        </div>
                        @endisset
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs">
                        @foreach($log->properties as $key => $value)
                            <div class="flex items-start">
                                <span class="font-medium text-gray-600 w-24">{{ str_replace('_', ' ', ucfirst($key)) }}:</span>
                                <span class="flex-1 text-gray-800 break-words">
                                    @if(is_array($value))
                                        @if($key === 'old' || $key === 'new')
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($value as $item)
                                                    <span class="px-2 py-1 bg-gray-100 rounded text-xs">
                                                        {{ $item }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            @foreach($value as $subKey => $subValue)
                                                @if(is_array($subValue))
                                                    <div class="ml-2 border-l-2 pl-2">
                                                        @foreach($subValue as $k => $v)
                                                            <div>
                                                                <span class="font-medium">{{ $k }}:</span>
                                                                {{ is_array($v) ? json_encode($v) : $v }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div>{{ $subValue }}</div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        {{ $value ?? 'N/A' }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Associated User -->
            @if($log->subject && $log->subject instanceof \App\Models\User)
                <div class="mt-3 pt-2 border-t border-gray-100 text-xs">
                    <span class="text-gray-500">User:</span>
                    <span class="font-medium">{{ $log->subject->email }}</span>
                </div>
            @endif
        </div>
    @endforeach
    
    @if($logs instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    @endif
</div>