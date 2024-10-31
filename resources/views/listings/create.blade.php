<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Create a Gig</h2>
      <p class="mb-4">Post a gig to find a developer</p>
    </header>

    <form method="POST" action="/listings" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Job Title</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
          placeholder="Example: Senior Laravel Developer" value="{{old('title')}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="job_reference_number" class="inline-block text-lg mb-2">Job Reference Number</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="job_reference_number"
          placeholder="Example: 2024/CVer/17/14" value="{{old('job_reference_number')}}" />

        @error('job_reference_number')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
    <label for="vacancies" class="inline-block text-lg mb-2">Number of Vacancies</label>
    <input type="number" class="border border-gray-200 rounded p-2 w-full" name="vacancies"
      placeholder="Enter number of vacancies" value="{{old('vacancies')}}" />

    @error('vacancies')
    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
    @enderror
</div>

<div class="mb-6">
    <label for="deadline" class="inline-block text-lg mb-2">Application Deadline</label>
    <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" name="deadline" required
    value="{{ old('deadline', isset($listing) ? date('Y-m-d\TH:i', strtotime($listing->deadline)) : '') }}" />

    @error('deadline')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>



      

      <div class="mb-6">
    <label for="file" class="inline-block text-lg mb-2">Upload Job Description (PDF)</label>
    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="file" accept=".pdf" />

    @error('file')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>


      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Create Gig</button>
        <a href="/" class="text-black ml-4">Back</a>
      </div>
    </form>
  </x-card>

  
</x-layout>
