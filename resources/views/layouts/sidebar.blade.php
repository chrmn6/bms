<div x-data="{ sidebarOpen: true }" class="flex">
    <div class="bg-[#FAFAFA] text-black p-3 flex-shrink-0" style="height: 100vh; top: 0; left: 0;">
        {{-- Header with Logo --}}
        <div class="flex items-center justify-between px-2">
            <div class="flex-shrink-0 transition-all duration-300"
                :class="sidebarOpen ? 'w-auto opacity-100' : 'w-0 opacity-0 overflow-hidden'">
                {{-- Logo image --}}
                @php $user = Auth::user(); @endphp
                @if ($user)
                    @if ($user->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <x-dashboard-logo class="block h-7 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    @else ($user->role === 'staff')
                        <a href="{{ route('staff.dashboard') }}">
                            <x-dashboard-logo class="block h-7 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}">
                        <x-dashboard-logo class="block h-7 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                @endif
            </div>

            {{-- Toggle button --}}
            <button @click="sidebarOpen = !sidebarOpen" class="text-black border-0 bg-transparent"
                aria-label="Toggle sidebar">
                <i class="bi bi-layout-sidebar"></i>
            </button>
        </div>

        {{-- Sidebar Links --}}
        @php $user = Auth::user(); @endphp
        <ul class="nav flex-column text-sm">
            {{-- Dashboard --}}
            <li>
                <x-sidebar-link :href="route($user->role === 'admin' ? 'admin.dashboard' : 'staff.dashboard')"
                    :active="request()->routeIs($user->role === 'admin' ? 'admin.dashboard' : 'staff.dashboard')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-bar-chart-line mr-2"></i>
                        <span x-show="sidebarOpen">Dashboard</span>
                    </span>
                </x-sidebar-link>
            </li>

            {{-- Profile --}}
            <li>
                <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-person mr-2"></i>
                        <span x-show="sidebarOpen">Profile</span>
                    </span>
                </x-sidebar-link>
            </li>

            {{-- Manage Users (Admin only) --}}
            @if($user->role === 'admin')
                <li>
                    <x-sidebar-link :href="route('admin.staff.index')" :active="request()->routeIs('admin.staff.index')">
                        <span class="inline-flex items-center">
                            <i class="bi bi-person-add mr-2"></i>
                            <span x-show="sidebarOpen">Manage Users</span>
                        </span>
                    </x-sidebar-link>
                </li>
            @endif

            {{-- Resident List (Admin + Staff) --}}
            @if(in_array($user->role, ['admin', 'staff']))
                <li>
                    <x-sidebar-link :href="route('admin.resident.index')"
                        :active="request()->routeIs('admin.resident.index')">
                        <span class="inline-flex items-center">
                            <i class="bi bi-people mr-2"></i>
                            <span x-show="sidebarOpen">Resident List</span>
                        </span>
                    </x-sidebar-link>
                </li>
            @endif

            {{-- Other links --}}
            <li>
                <x-sidebar-link :href="route('announcements.index')"
                    :active="request()->routeIs('announcements.index')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-megaphone mr-2"></i>
                        <span x-show="sidebarOpen">Announcement</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-globe mr-2"></i>
                        <span x-show="sidebarOpen">Activities</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('clearances.index')" :active="request()->routeIs('clearances.*')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-files mr-2"></i>
                        <span x-show="sidebarOpen">Clearance</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('blotters.index')" :active="request()->routeIs('blotters.*')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-folder mr-2"></i>
                        <span x-show="sidebarOpen">Blotter Report</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('settings.edit')" :active="request()->routeIs('settings.*')">
                    <span class="inline-flex items-center">
                        <i class="bi bi-gear mr-2"></i>
                        <span x-show="sidebarOpen">Settings</span>
                    </span>
                </x-sidebar-link>
            </li>

            {{-- Logout --}}
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-sidebar-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="inline-flex items-center">
                            <i class="bi bi-box-arrow-right mr-2"></i>
                            <span x-show="sidebarOpen">Sign Out</span>
                        </span>
                    </x-sidebar-link>
                </form>
            </li>
        </ul>
    </div>

    <div :class="sidebarOpen ? 'ml-0' : 'ml-0'">
        @yield('content')
    </div>
</div>