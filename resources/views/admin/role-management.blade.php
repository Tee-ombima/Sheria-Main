<x-layout>
    <!-- Statistics Cards (Same as before) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-700">{{ $totalUsers }}</p>
                    <p class="text-sm text-gray-500">Total Users</p>
                </div>
                <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        <!-- Verified Users Card -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-700">{{ $verifiedUsers }}</p>
                    <p class="text-sm text-gray-500">Verified Users</p>
                </div>
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- Unverified Users Card -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-700">{{ $unverifiedUsers }}</p>
                    <p class="text-sm text-gray-500">Unverified Users</p>
                </div>
                <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- Admin Users Card -->
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-gray-700">{{ $adminUsers }}</p>
                    <p class="text-sm text-gray-500">Admin Users</p>
                </div>
                <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <x-card class="p-8 max-w-6xl mx-auto">
        <header class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">User Role Management</h2>
        </header>

        @if (session('message'))
        <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-6 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-green-700">{{ session('message') }}</span>
        </div>
        @endif

        <!-- Enhanced Search Form (Same as before) -->
        <form method="GET" action="{{ route('admin.role-management') }}" class="mb-6">
            <div class="flex gap-2">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                           placeholder="Search users by name or email..." 
                           class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-[#D68C3C] focus:ring-2 focus:ring-[#D68C3C]">
                    <svg class="w-5 h-5 absolute left-3 top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button type="submit" class="px-6 bg-[#D68C3C] text-white rounded-lg hover:bg-[#bf7a2e] transition-colors flex items-center">
                    <span class="hidden md:inline">Search</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Enhanced Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                            <!-- Toggle Role Switch with Confirmation -->
                            <form id="toggle-role-form-{{ $user->id }}" method="POST" action="{{ route('admin.role-management.toggleRole', $user->id) }}">
                                @csrf
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" 
                                           {{ $user->role === 'admin' ? 'checked' : '' }}
                                           onchange="confirmRoleChange(event, {{ $user->id }}, '{{ $user->role }}')">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D68C3C]"></div>
                                </label>
                            </form>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:text-red-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No users found matching your criteria</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Enhanced Pagination -->
        <div class="mt-6">
            {{ $users->appends(['search' => $search])->links('pagination::tailwind') }}
        </div>
    </x-card>

    <script>
        // Confirmation before toggling user role
        function confirmRoleChange(event, userId, currentRole) {
            const newRole = currentRole === 'admin' ? 'user' : 'admin';
            const confirmation = confirm(`Are you sure you want to change this user's role from ${currentRole} to ${newRole}?`);

            if (!confirmation) {
                event.preventDefault(); // Prevent form submission
                const form = document.getElementById(`toggle-role-form-${userId}`);
                const checkbox = form.querySelector('input[type="checkbox"]');
                checkbox.checked = currentRole === 'admin'; // Reset checkbox state
            } else {
                // Submit the form if confirmed
                document.getElementById(`toggle-role-form-${userId}`).submit();
            }
        }

        // Add loading state for form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', (e) => {
                const submitBtn = form.querySelector('button[type="submit"]');
                if(submitBtn) {
                    submitBtn.innerHTML = `
                        <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        Processing...`;
                    submitBtn.disabled = true;
                }
            });
        });
    </script>
</x-layout>