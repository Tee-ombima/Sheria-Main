@foreach($applications as $application)
  <tr class="hover:bg-gray-50 transition-colors">
    <td class="p-3 text-gray-700">{{ $application->user->personalInfo->idno }}</td>
    <td class="p-3 text-gray-700">{{ $application->user->personalInfo->firstname }} {{ $application->user->personalInfo->lastname }}</td>
    <td class="p-3 text-gray-700">{{ $application->user->personalInfo->gender ?? 'N/A' }}</td>
    <td class="p-3 text-gray-700">{{ $application->user->personalInfo->homecounty->name ?? 'N/A' }}</td>
    <td class="p-3 text-gray-700">{{ $application->user->personalInfo->subcounty->name ?? 'N/A' }}</td>
    <td class="p-3 text-gray-700">{{ $application->user->personalInfo->constituency->name ?? 'N/A' }}</td>
    <td class="p-3 text-gray-700 truncate max-w-[200px]" title="{{ $application->user->email }}">{{ $application->user->email }}</td>
  </tr>
@endforeach