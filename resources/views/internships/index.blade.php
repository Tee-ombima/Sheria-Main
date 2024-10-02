<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center mb-6">
            <h2 class="text-2xl font-bold uppercase">Your Internship Applications</h2>
        </header>

        @if ($internships->isEmpty())
            <p class="text-center text-gray-600">You have not applied for any internships yet.</p>
        @else
            <table class="min-w-full bg-white border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Full Name</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Department</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-600 border-b">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($internships as $application)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $application->full_name }}</td>
                            <td class="px-6 py-4 border-b">{{ $application->department->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border-b">{{ $application->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
    </x-card>
</x-layout>
