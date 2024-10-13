<x-layout>
    <x-card class="p-10 max-w-full mx-auto mt-24 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">{{ $department->name }} Applications</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="py-3 px-5 text-left">#</th> <!-- Numbering Column -->
                    <th class="py-3 px-5 text-left">Full Name</th>
                    <th class="py-3 px-5 text-left">Email</th>
                    <th class="py-3 px-5 text-left">Phone Number</th>
                    <th class="py-3 px-5 text-left">Institution Name</th>
                    <th class="py-3 px-5 text-left">Status</th>
                    <th class="py-3 px-5 text-left">ID File</th>
                    <th class="py-3 px-5 text-left">University Letter</th>
                    <th class="py-3 px-5 text-left">KRA PIN</th>
                    <th class="py-3 px-5 text-left">Insurance</th>
                    <th class="py-3 px-5 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $index => $application) <!-- Add index for numbering -->
                    <tr class="border-t border-gray-200">
                        <td class="py-3 px-5 text-gray-600">{{ $index + 1 }}</td> <!-- Numbering -->
                        <td class="py-3 px-5 text-gray-600">{{ $application->full_name }}</td>
                        <td class="py-3 px-5 text-gray-600">{{ $application->email }}</td>
                        <td class="py-3 px-5 text-gray-600">{{ $application->phone }}</td>
                        <td class="py-3 px-5 text-gray-600">{{ $application->institution }}</td>
                        <td class="py-3 px-5 text-gray-600">{{ $application->status }}</td>
                        <td class="py-3 px-5 text-gray-600">
                            <a href="{{ asset('storage/' . $application->id_file) }}" target="_blank" class="text-blue-500 underline">View Document</a>
                        </td>
                        <td class="py-3 px-5 text-gray-600">
                            <a href="{{ asset('storage/' . $application->university_letter) }}" target="_blank" class="text-blue-500 underline">View Document</a>
                        </td>
                        <td class="py-3 px-5 text-gray-600">
                            <a href="{{ asset('storage/' . $application->kra_pin) }}" target="_blank" class="text-blue-500 underline">View Document</a>
                        </td>
                        <td class="py-3 px-5 text-gray-600">
                            <a href="{{ asset('storage/' . $application->insurance) }}" target="_blank" class="text-blue-500 underline">View Document</a>
                        </td>
                        <td class="py-3 px-5">
                            <form action="{{ route('admin.internships.destroy', $application->id) }}" method="POST" class="space-y-2">
                                @csrf
                                @method('DELETE') <!-- Use DELETE method for removal -->
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Remove from List
                                </button>
                            </form>
                            <form action="{{ route('admin.internships.update', $application->id) }}" method="POST" class="space-y-2">
                                @csrf
                                @method('PATCH')
                                <div>
                                    <select name="status" class="w-full py-2 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Accepted" {{ $application->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <div>
                                    <input type="text" name="remarks" value="{{ $application->remarks }}" placeholder="Enter remarks" class="w-full py-2 px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $applications->links() }}
        </div>

    </x-card>
</x-layout>
