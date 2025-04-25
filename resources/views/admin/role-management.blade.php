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
<!-- Modify the search form in role-management.blade.php -->
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
        <select name="filter" class="rounded-lg border border-gray-200 focus:border-[#D68C3C] focus:ring-2 focus:ring-[#D68C3C]">
            <option value="all" {{ request('filter') === 'all' ? 'selected' : '' }}>All Users</option>
            <option value="admins" {{ request('filter') === 'admins' ? 'selected' : '' }}>Admins Only</option>
            <option value="unverified" {{ request('filter') === 'unverified' ? 'selected' : '' }}>Unverified</option>
            <option value="verified" {{ request('filter') === 'verified' ? 'selected' : '' }}>Verified Only</option>
        </select>
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
                    <!-- Add Permissions column -->
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
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
                    <!-- Permissions Column -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->permissions ?? [] as $permission)
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                    {{ $permission }}
                                </span>
                            @endforeach
                            @if(!$user->permissions)
                                <span class="text-gray-400 text-xs">No permissions</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                        <!-- Add Permissions Edit Button (Visible only to superadmin) -->
                        @if(auth()->user()->isSuperAdmin())
                        <button onclick="openPermissionsModal({{ $user->id }})" 
                                class="p-2 text-[#D68C3C] hover:text-[#bf7a2e] transition-colors"
                                title="Edit Permissions">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                                    <span class="ml-1">Edit Permissions</span>

                        </button>
                        @endif
                        <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                            <!-- Toggle Role Switch with Confirmation -->
                            <form id="toggle-role-form-{{ $user->id }}" method="POST" action="{{ route('admin.role-management.toggleRole', $user->id) }}">
                                @csrf
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" 
                                           {{ $user->role === 'admin' ? 'checked' : '' }}
                                           onchange="confirmRoleChange(event, {{ $user->id }}, '{{ $user->role }}')">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#D68C3C]"></div>
                                                                        <span class="ml-1">Change Role</span>

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
        

         <!-- Permissions Modal -->
    @if(auth()->user()->isSuperAdmin())
    <div id="permissionsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-bold mb-4">Edit Permissions</h3>
            <form id="permissionsForm" method="POST">
                @csrf
                    @method('PUT') <!-- Add this line -->

                <div class="space-y-2">
                    @foreach(['manage_listings', 'manage_internships', 'manage_pupillages', 'manage_post_pupillages'] as $permission)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="permissions[]" value="{{ $permission }}" 
                               class="rounded border-gray-300 text-[#D68C3C] focus:ring-[#D68C3C]">
                        <span class="text-gray-700">{{ ucwords(str_replace('_', ' ', $permission)) }}</span>
                    </label>
                @endforeach
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closePermissionsModal()" 
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-[#D68C3C] text-white rounded hover:bg-[#bf7a2e]">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif


@if($users->hasPages())
    <div class="mt-6">
        {{ $users->appends(['search' => $search,
    'filter' => $filter])->onEachSide(3)->links('pagination::tailwind') }}
    </div>
@endif
<!-- Add to your unified-log.blade.php -->
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-2xl font-bold">Activity Logs</h2>
    <a href="{{ route('logs.export') }}" 
       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
        <i class="fas fa-download mr-2"></i> Export Logs
    </a>
</div>
        <x-unified-log :logs="\Spatie\Activitylog\Models\Activity::latest()->take(20)->get()" />

    </x-card>
<script>
  // ————————————————
  // 1) Confirm before toggling user role
  // ————————————————
  function confirmRoleChange(event, userId, currentRole) {
    event.preventDefault(); // stop the checkbox/form for now

    const form = document.getElementById(`toggle-role-form-${userId}`);
    const checkbox = form.querySelector('input[type="checkbox"]');
    const newRole = currentRole === 'admin' ? 'user' : 'admin';
    const confirmMsg = `Are you sure you want to change this user's role from ${currentRole} to ${newRole}?`;

    if (!confirm(confirmMsg)) {
      // user cancelled → revert the checkbox
      checkbox.checked = (currentRole === 'admin');
      return;
    }

    // user confirmed → submit the form
    form.submit();
  }

  // ————————————————
  // 2) Permissions modal open/close
  // ————————————————
  const users = @json($users->keyBy('id')->toArray());

  function openPermissionsModal(userId) {
    const userData = users[userId] || {};
    const form     = document.getElementById('permissionsForm');

    // set form action
    form.action = `/users/${userId}/permissions`;

    // tick the boxes that this user already has
    form.querySelectorAll('input[type="checkbox"]').forEach(cb => {
      cb.checked = Array.isArray(userData.permissions) && userData.permissions.includes(cb.value);
    });

    document.getElementById('permissionsModal').classList.remove('hidden');
  }

  function closePermissionsModal() {
    document.getElementById('permissionsModal').classList.add('hidden');
  }

  // click outside the dialog closes it
  document.getElementById('permissionsModal')
          .addEventListener('click', e => {
    if (e.target.id === 'permissionsModal') {
      closePermissionsModal();
    }
  });

  // ————————————————
  // 3) Loading spinner on every form submit
  // ————————————————
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', () => {
      const btn = form.querySelector('button[type="submit"]');
      if (!btn) return;

      btn.innerHTML = `
        <svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        Processing...
      `;
      btn.disabled = true;
    });
  });
</script>

</x-layout>
