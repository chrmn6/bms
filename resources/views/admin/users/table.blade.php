<table id="usersTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
    hx-get="{{ route('admin.staff.index') }}" hx-trigger="refreshTable from:body" hx-target="this" hx-swap="innerHTML">
    <thead class="text-center text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            'admin' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                            'staff' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
                            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700'],
                        };
                    @endphp

                    <span
                        class="px-1.5 py-1 rounded-md font-semibold text-xs {{ $statusColors['bg'] }} {{ $statusColors['text'] }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td class="px-3 py-2">
                    @if ($isCurrentUser)
                        <span class="badge bg-info">Current User</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                </td>
                <td class="px-3 py-2">
                    <x-primary-button hx-get="{{ route('admin.staff.show', $user->id) }}" hx-target="#viewUserModalBody"
                        hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#viewUserModal"
                        class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                        <i class="bi bi-eye text-xs"></i>
                    </x-primary-button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>