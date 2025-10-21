<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
        <script src="{{ asset('js/users-scripts.js') }}"></script>
    @endpush

    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Staff Accounts') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3 flex justify-end">
            <x-primary-button type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-2">
                <ion-icon name="add-circle-outline" class="text-base"></ion-icon>Add New User
            </x-primary-button>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-table"></i>
                    System Users
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Account Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @php
                                    $isCurrentUser = Auth::check() && Auth::id() === $user->id;
                                @endphp
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <div>
                                            <div>
                                                <strong>{{ $user->first_name }}
                                                    {{ $user->last_name }}</strong><br>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($isCurrentUser)
                                            <span class="badge bg-info">Current User</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $user->created_at->format('M d, Y') }}</span><br>
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <x-primary-button type="button" onclick="viewUser({{ $user->id }})"
                                            title="View Details"
                                            class="!bg-blue-500 hover:!bg-blue-600 active:!bg-blue-700 flex items-center justify-center">
                                            <ion-icon name="eye-outline" class="text-sm"></ion-icon>
                                        </x-primary-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-person-plus"></i>
                            Add New User
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm" action="{{ route('admin.staff.store') }}" method="POST">
                            @csrf
                            <div class="row g-3 mb-2">
                                <div class="col-md-6">
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <x-text-input id="first_name" name="first_name" type="text"
                                        class="mt-1 block w-full" :value="old('first_name')" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                </div>

                                <div class="col-md-6">
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                        :value="old('last_name')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                </div>
                            </div>

                            <div class="row g-3 mb-2">
                                <!-- Email -->
                                <div class="col-md-6">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                        :value="old('email')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                                    <x-text-input id="phone_number" name="phone_number" type="text"
                                        class="mt-1 block w-full" :value="old('phone_number')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                                </div>
                            </div>

                            <div class="row g-3 mb-2">
                                <!-- Password -->
                                <div class="col-md-6">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" name="password" type="password"
                                        class="mt-1 block w-full" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="password_confirmation" name="password_confirmation"
                                        type="password" class="mt-1 block w-full" required />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>
                                    {{ __('Create Staff') }}
                                </x-primary-button>

                                @if(session('status') === 'staff-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Staff account created.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- View User Modal -->
        <div class="modal fade" id="viewUserModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-eye"></i>
                            User Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div id="userDetails">
                            <!-- User details will be loaded here -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>