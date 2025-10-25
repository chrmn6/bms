<div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    {{-- Sidebar --}}
    <nav class="flex flex-col h-screen bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 transition-all duration-300"
        :class="sidebarOpen ? 'w-64' : 'w-16'">

        {{-- Hamburger for small screens --}}
        <div class="flex items-center justify-between py-2 px-4 border-b border-gray-200 dark:border-gray-700">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 dark:text-gray-300 focus:outline-none">
                <ion-icon class="w-6 h-6" name="menu-outline"></ion-icon>
            </button>

            {{-- Logo --}}
            @php $user = Auth::user(); @endphp
            @if ($user)
                @if ($user->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                @elseif ($user->role === 'staff')
                    <a href="{{ route('staff.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                @else
                    <a href="{{ route('residents.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            @endif
        </div>

        {{-- Sidebar content --}}
        <div class="flex flex-col flex-grow overflow-y-auto pt-2">
            {{-- Navigation Links --}}
            <div class="flex-grow px-2 space-y-2">
                @if ($user)
                    {{-- Dashboard --}}
                    <x-nav-link :href="route($user->role === 'admin' ? 'admin.dashboard' : ($user->role === 'staff' ? 'staff.dashboard' : 'residents.dashboard'))" :active="request()->routeIs($user->role === 'admin' ? 'admin.dashboard' : ($user->role === 'staff' ? 'staff.dashboard' : 'residents.dashboard'))">
                        <span class="inline-flex items-center">
                            <ion-icon name="stats-chart-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Dashboard</span>
                        </span>
                    </x-nav-link>

                    {{-- Profile --}}
                    @php
                        $profileRoute = ($user->role === 'resident') ? 'residents.edit' : 'profile.edit';
                    @endphp
                    <x-nav-link :href="route($profileRoute)" :active="request()->routeIs($profileRoute)">
                        <span class="inline-flex items-center">
                            <ion-icon name="person-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Profile</span>
                        </span>
                    </x-nav-link>

                    {{-- Manage Users and Residents List --}}
                    @if($user->role === 'admin')
                        <x-nav-link :href="route('admin.staff.index')" :active="request()->routeIs('admin.staff.index')">
                            <span class="inline-flex items-center">
                                <ion-icon name="people-circle-outline" class="w-5 h-5 mr-2"></ion-icon>
                                <span x-show="sidebarOpen">Manage Users</span>
                            </span>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.resident.index')" :active="request()->routeIs('admin.resident.index')">
                            <span class="inline-flex items-center">
                                <ion-icon name="people-outline" class="w-5 h-5 mr-2"></ion-icon>
                                <span x-show="sidebarOpen">Resident List</span>
                            </span>
                        </x-nav-link>
                    @endif

                    {{-- Other links --}}
                    <x-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.index')">
                        <span class="inline-flex items-center">
                            <ion-icon name="megaphone-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Announcements</span>
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                        <span class="inline-flex items-center">
                            <ion-icon name="globe-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Activities</span>
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('clearances.index')" :active="request()->routeIs('clearance.*')">
                        <span class="inline-flex items-center">
                            <ion-icon name="reader-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Clearance</span>
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('blotters.index')" :active="request()->routeIs('blotters.*')">
                        <span class="inline-flex items-center">
                            <ion-icon name="newspaper-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Blotter Report</span>
                        </span>
                    </x-nav-link>

                    <x-nav-link :href="route('settings.edit')" :active="request()->routeIs('settings.*')">
                        <span class="inline-flex items-center">
                            <ion-icon name="settings-outline" class="w-5 h-5 mr-2"></ion-icon>
                            <span x-show="sidebarOpen">Settings</span>
                        </span>
                    </x-nav-link>

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <span class="inline-flex items-center">
                                <ion-icon name="log-out-outline" class="w-5 h-5 mr-2"></ion-icon>
                                <span x-show="sidebarOpen">Sign Out</span>
                            </span>
                        </x-nav-link>
                    </form>
                @endif
            </div>
        </div>
    </nav>
</div>