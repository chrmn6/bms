<table id="usersTable" class="table table-hover text-center" hx-get="{{ route('admin.staff.index') }}"
    hx-trigger="refreshTable from:body" hx-target="this" hx-swap="outerHTML">
    <thead class="table-light">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Account Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            @php $isCurrentUser = Auth::check() && Auth::id() === $user->id; @endphp
            <tr>
                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge bg-success">{{ ucfirst($user->role) }}</span>
                </td>
                <td>
                    @if ($isCurrentUser)
                        <span class="badge bg-info">Current User</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
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