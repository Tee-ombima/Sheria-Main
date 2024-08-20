<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
<!-- resources/views/users/profile.blade.php -->

    <h2>Update Your Profile</h2>
    <form action="{{ route('profile.submit') }}" method="POST">
    @csrf
    @method('POST')
        <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control border border-gray-300 p-2 rounded" id="name" name="name" value="{{ Auth::user()->name }}">
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control border border-gray-300 p-2 rounded" id="email" name="email" value="{{ Auth::user()->email }}">
</div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

</x-card>
</x-layout>