<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Accounts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('staff.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                + Create Staff
            </a>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Phone</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $user)
                            <tr>
                                <td class="p-2 border">{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td class="p-2 border">{{ $user->email }}</td>
                                <td class="p-2 border">{{ $user->phone_number }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('staff.edit', $user->id) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('staff.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>