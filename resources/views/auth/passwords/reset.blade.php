<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Reset Password</h2>
    </header>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

      <!-- Email Input -->
      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="border border-gray-200 rounded p-2 w-full @error('email') @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password Input -->
      <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">{{ __('Password') }}</label>
        <input id="password" type="password" class="border border-gray-200 rounded p-2 w-full @error('password')  @enderror" name="password" required autocomplete="new-password">
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirm Password Input -->
      <div class="mb-6">
        <label for="password-confirm" class="inline-block text-lg mb-2">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" required autocomplete="new-password">
      </div>

      <!-- Submit Button -->
      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          {{ __('Reset Password') }}
        </button>
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
