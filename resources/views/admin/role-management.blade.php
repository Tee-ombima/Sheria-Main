<x-layout>
    <x-card class="p-10 max-w-6xl mx-auto mt-24">
        <header class="text-center mb-6">
            <h2 class="text-2xl font-bold uppercase">User Role Management</h2>
        </header>

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.role-management') }}" class="mb-4">
            <div class="flex items-center justify-between">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by email..." 
                    class="border border-gray-200 rounded p-2 w-full">
                <button type="submit" class="ml-2 bg-laravel text-white py-2 px-4 rounded hover:bg-black">
                    Search
                </button>
            </div>
        </form>

        <!-- User List Table -->
        <table class="min-w-full table-auto">
            <thead class="border-b">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>
                        <td class="px-4 py-2">
                            <form method="POST" action="{{ route('admin.role-management.toggleRole', $user->id) }}">
                                @csrf
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-green-500"
                                           {{ $user->role === 'admin' ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                    <span class="ml-2">{{ $user->role === 'admin' ? 'Admin' : 'User' }}</span>
                                </label>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->appends(['search' => $search])->links() }}
        </div>
    </x-card>
</x-layout>
