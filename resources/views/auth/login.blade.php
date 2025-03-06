<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Login</h2>
      <p class="mb-4">Log into your account to apply for a career</p>
    </header>

    @if (session('message'))
      <div class="bg-green-500 text-white p-3 rounded mb-4">
          {{ session('message') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Input -->
      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">Email</label>
        <input id="email" type="email" class="border border-gray-200 rounded p-2 w-full @error('email')  @enderror" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password Input -->
      <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">Password</label>
        <input id="password" type="password" class="border border-gray-200 rounded p-2 w-full @error('password') @enderror" name="password" required>
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Remember Me Checkbox -->
      <div class="mb-6">
        <div class="flex items-center">
          <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label for="remember" class="text-lg">Remember Me</label>
        </div>
      </div>

      <!-- Sign In Button -->
      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Sign In</button>
      </div>

      <!-- Forgot Password Link -->
      <div class="mb-6">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-laravel">Forgot Password?</a>
        @endif
      </div>

      <!-- Register Link -->
      <div class="mt-8">
        <p>Don't have an account? <a href="/register" class="text-laravel">Register</a></p>
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
