<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Staff Account') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('staff.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="border p-2 w-full">
                        @error('first_name') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="border p-2 w-full">
                        @error('last_name') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full">
                        @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                            class="border p-2 w-full">
                        @error('phone_number') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Password</label>
                        <input type="password" name="password" class="border p-2 w-full">
                        @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="border p-2 w-full">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Create Staff
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>