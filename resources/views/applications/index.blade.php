<x-layout>
    <x-card class="p-10 mx-auto mt-24">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Status of My Applications</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID No.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Reference Number</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($applications as $application)
                        <tr class="hover:bg-gray-100">
<td class="px-4 py-2 whitespace-nowrap">
    {{ ($applications->currentPage() - 1) * $applications->perPage() + $loop->iteration }}
</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $application->idno }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $application->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $application->job_title }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $application->job_reference_number }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $application->job_status }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">{{ $application->remarks }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    </x-card>
</x-layout>
