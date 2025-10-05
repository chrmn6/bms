<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Welcome back, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!
        </h2>
    </x-slot>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition
            class="fixed top-10 px-6 py-3 rounded shadow-lg z-50"
            style="background-color: #16a34a; color: #ffffff; min-width: 200px; left: 50%; transform: translateX(-50%);">
            {{ session('success') }}
            <button @click="show = false" style="color: #ffffff;" class="ml-2 font-bold float-right">×</button>
        </div>
    @endif


    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ "KAPOY NAMAN" }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>