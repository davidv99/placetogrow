<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View my user') }}
        </h2>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View my user</title>
    </x-slot>

    @section('content')
    <div class="container mx-auto mt-5 flex-col space-y-4 items-center">
        <h1 class="text-2xl font-bold mb-4 flex flex-col items-center">View my user</h1>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="flex flex-col max-w-lg mx-auto mt-4 items-center">
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label class="block mb-2 w-full font-bold px-4 py-3">Name: {{ old('name', $user->name) }}</label>
            </div>

            <div class="mb-4">
                <label class="block mb-2 w-full font-bold px-4 py-3">Email: {{ old('name', $user->email) }}</label>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-bold w-full px-4 py-3">Role: {{ old('role', $role_name[0]) }}</label>
            </div>
            <button type="submit" class="my-button"><i class="fas fa-trash"></i></button>
        </form>
    </div>
    @endsection
</x-app-layout>