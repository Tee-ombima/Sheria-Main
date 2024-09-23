<x-layout>
<h1 class="text-2xl mb-4">Manage Users</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.userindex') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by email"
               class="px-4 py-2 border rounded" />
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Search</button>
    </form>

    <!-- Users Table -->
    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Role</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-6 py-2">{{ $user->name }}</td>
                    <td class="border px-6 py-2">{{ $user->email }}</td>
                    <td class="border px-6 py-2">
                        <form method="POST" action="{{ route('admin.users.update-role', $user->id) }}">
                            @csrf
                            <select name="role" onchange="this.form.submit()" class="px-2 py-1 border rounded">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                    <td class="border px-6 py-2">
                        <!-- Additional actions can go here -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
    </x-layout>
