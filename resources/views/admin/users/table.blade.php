<table id="usersTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    hx-get="{{ route('admin.staff.index') }}" hx-trigger="refreshTable from:body" hx-target="this" hx-swap="innerHTML">
    <thead class="text-sm text-center text-gray-700 bg-slate-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-3 py-2">Staff ID</th>
            <th scope="col" class="px-3 py-2">Full Name</th>
            <th scope="col" class="px-3 py-2">Email Id</th>
            <th scope="col" class="px-3 py-2">Role</th>
            <th scope="col" class="px-3 py-2">Status</th>
            <th scope="col" class="px-3 py-2">Actions</th>
        </tr>
    </thead>
    <tbody class="text-center border border-gray-200 dark:border-gray-700 rounded-lg">
        @foreach($users as $user)
            @php $isCurrentUser = Auth::check() && Auth::id() === $user->id; @endphp
            <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 divide-x divide-gray-100">
                <td class="px-3 py-2">
                    {{ $user->display_id }}
                </td>
                <th class="flex items-center px-2 py-2 text-gray-900 dark:text-white">
                    <img class="w-8 h-8 rounded-full" src="{{ asset('uploads/users/' . $user->image) }}"
                        alt="{{ $user->full_name }}">
                    <div class="ps-2">
                        <div class="text-sm font-semibold">{{ $user->full_name }}</div>
                    </div>
                </th>
                <td class="px-3 py-2">{{ $user->email }}</td>
                <td class="px-3 py-2">
                    @php
                        $statusColors = match ($user->role) {
                            'admin' => ['text' => 'text-green-500'],
                            'staff' => ['text' => 'text-yellow-500'],
                            default => ['text' => 'text-gray-500'],
                        };
                    @endphp

                    <span class="px-1.5 py-1 rounded-md font-semibold text-sm {{ $statusColors['text'] }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td class="px-3 py-2">
                    @if ($isCurrentUser)
                        <span class="text-blue-500 text-sm font-semibold">Current User</span>
                    @else
                        @if ($user->status === 'Active')
                            <span class="text-green-500 text-sm font-semibold">
                                Active
                            </span>
                        @else
                            <span class="text-red-500 text-sm font-semibold">
                                Inactive
                            </span>
                        @endif
                    @endif
                </td>
                <td class="px-3 py-2">
                    <x-primary-button hx-get="{{ route('admin.staff.show', $user->id) }}" hx-target="#viewUserModalBody"
                        hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#viewUserModal"
                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                        <svg class="w-[15px] h-[15px] text-whitedark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </x-primary-button>
                    <x-primary-button hx-get="{{ route('admin.staff.edit', $user->id) }}" hx-target="#editStaffModalBody"
                        hx-swap="innerHTML" data-bs-toggle="modal" data-bs-target="#editStaffModal"
                        class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
                        <svg class="w-[15px] h-[15px] text-white dark:text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                        </svg>
                    </x-primary-button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>