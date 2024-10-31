<x-layout>
  <x-card class="p-10 mx-auto mt-24">

  <h2>Status of My Applications</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ID No.</th>
                <th>Name</th>
                <th>Job Title</th>
                <th>Job Reference Number</th>
                <th>Job Status</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $application->idno }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->job_title }}</td>
                    <td>{{ $application->job_reference_number }}</td>
                    <td>{{ $application->job_status }}</td>
                    <td>{{ $application->remarks }}</td>
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