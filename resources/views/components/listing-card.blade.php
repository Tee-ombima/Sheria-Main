@props(['listing'])

<x-card>
  <div class="flex">
    
    <div>
      <h3 class="text-2x1">
        <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
        <span class="text-sm text-blue-500">
        <a href="/listings/{{$listing->id}}" class="ml-2">View</a>
    </span>
      </h3>
      <div class="flex items-center justify-center rounded-xl py-1 px-3 mr-2 text-xs" style="background-color: #D68C3C; color: #FFFFFF;">
        Number of vacancies available: {{ $listing->vacancies }}
      </div>

      
    </div>
  </div>
</x-card>