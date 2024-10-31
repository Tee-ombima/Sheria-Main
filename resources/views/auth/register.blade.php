<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Register</h2>
      <p class="mb-4">Create an account to apply for careers</p>
    </header>

    @if (session('message'))
      <div class="bg-green-500 text-white p-3 rounded mb-4">
          {{ session('message') }}
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name Field -->
      <div class="mb-6">
        <label for="name" class="block text-lg mb-2">Name</label>
        <input id="name" type="text" class="border border-gray-200 rounded p-2 w-full @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email Field -->
      <div class="mb-6">
        <label for="email" class="block text-lg mb-2">Email Address</label>
        <input id="email" type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ old('email') }}" required>
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password Field -->
      <div class="mb-6">
        <label for="password" class="block text-lg mb-2">Password</label>
        <input id="password" type="password" class="border border-gray-200 rounded p-2 w-full" name="password" required>
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password Confirmation Field -->
      <div class="mb-6">
        <label for="password-confirm" class="block text-lg mb-2">Confirm Password</label>
        <input id="password-confirm" type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" required>
      </div>

      <!-- Submit Button -->
      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Sign Up
        </button>
      </div>

      <div class="mt-8">
        <p>
          Already have an account?
          <a href="/login" class="text-laravel">Login</a>
        </p>
      </div>
    </form>
  </x-card>

  <script>
      document.querySelector("form").addEventListener("submit", function() {
          // Show the loader
          document.getElementById("loader").style.display = "flex";
      });
  </script>
</x-layout>
