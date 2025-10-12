<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Accounts') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('staff.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                        Create Staff
                    </a>

                    <table class="table-auto mt-3 w-full border border-gray-300 dark:border-gray-600">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Name</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Email</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Phone</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff as $user)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="p-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>
                                    <td class="p-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $user->email }}
                                    </td>
                                    <td class="p-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $user->phone_number }}
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 flex gap-2 justify-center">
                                        <a href="{{ route('staff.edit', $user->id) }}"
                                            class="px-2 py-1 bg-yellow-500 text-black rounded hover:bg-yellow-600 text-sm flex items-center justify-center">
                                            <ion-icon name="pencil-outline" class="text-base"></ion-icon>
                                        </a>
                                        <form action="{{ route('staff.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this staff?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2 py-1 bg-red-600 text-black rounded hover:bg-red-700 text-sm flex items-center justify-center">
                                                <ion-icon name="trash-outline" class="text-base"></ion-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $staff->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>