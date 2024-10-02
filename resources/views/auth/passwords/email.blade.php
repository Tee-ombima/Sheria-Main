<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Reset Password</h2>
    </header>

    @if (session('status'))
      <div class="bg-green-500 text-white p-3 rounded mb-4">
          {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <!-- Email Input -->
      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="border border-gray-200 rounded p-2 w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit Button -->
      <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          {{ __('Send Password Reset Link') }}
        </button>
      </div>
    </form>
  </x-card>
</x-layout>
