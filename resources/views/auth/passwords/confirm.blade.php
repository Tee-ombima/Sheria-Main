<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Confirm Password</h2>
    </header>

    <div class="mb-4 text-center">
        <p class="mb-4">{{ __('Please confirm your password before continuing.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
      @csrf

      <!-- Password Input -->
      <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">{{ __('Password') }}</label>
        <input id="password" type="password" class="border border-gray-200 rounded p-2 w-full @error('password') @enderror" name="password" required autocomplete="current-password">
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          {{ __('Confirm Password') }}
        </button>
      </div>

      <!-- Forgot Password Link -->
      @if (Route::has('password.request'))
      <div class="mb-6">
        <a href="{{ route('password.request') }}" class="text-laravel">
          {{ __('Forgot Your Password?') }}
        </a>
      </div>
      @endif
    </form>
  </x-card>

  <script>
      document.querySelector("form").addEventListener("submit", function() {
          // Show the loader
          document.getElementById("loader").style.display = "flex";
      });
  </script>
</x-layout>
