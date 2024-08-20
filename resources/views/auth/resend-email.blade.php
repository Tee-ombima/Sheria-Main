<x-layout>

    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">Resend Verification Email</h2>
        </header>

        <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="text-laravel">Resend Verification Email</button>
    </form>
    </x-card>
</x-layout>
