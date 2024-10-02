<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Verify Your Email Address</h2>
    </header>

    <div class="mb-4 text-center">
        @if (session('resent'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="mb-4">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>
        <p class="mb-4">
            {{ __('If you did not receive the email') }},
        </p>

        <form method="POST" action="{{ route('verification.resend') }}" class="inline-block">
            @csrf
            <button type="submit" class="text-laravel underline hover:text-black">
                {{ __('click here to request another') }}
            </button>
        </form>
    </div>
  </x-card>
</x-layout>
