<x-app-layout>
    <x-slot name="header">
        <div class="container py-4">
            <h1 class="text-center mb-0">
                {{ __('Dashboard') }}
            </h1>
        </div>
    </x-slot>

    <hr>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <hr>

</x-app-layout>
