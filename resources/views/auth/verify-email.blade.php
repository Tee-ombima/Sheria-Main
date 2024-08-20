<x-layout>

<x-card class="p-10 max-w-lg mx-auto mt-24">
  <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Verify your email</h2>
      <p class="mb-4">Check your email</p>
  </header>

  <p>
        Before proceeding, please check your email for a verification link.
        If you did not receive the email,
        <a href="{{ route('verification.resend-form') }}" class="text-laravel">click here to request another</a>.
    </p>

</x-card>
</x-layout>
