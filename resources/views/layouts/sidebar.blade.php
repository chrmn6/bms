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
                <svg class="w-[24px] h-[24px] text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M7.99994 10 6 11.9999l1.99994 2M11 5v14m-7 0h16c.5523 0 1-.4477 1-1V6c0-.55228-.4477-1-1-1H4c-.55228 0-1 .44772-1 1v12c0 .5523.44772 1 1 1Z" />
                </svg>
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
                        <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                        </svg>
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
                            <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1"
                                    d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
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
                            <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                            </svg>
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
                        <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M11 9H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6m0-6v6m0-6 5.419-3.87A1 1 0 0 1 18 5.942v12.114a1 1 0 0 1-1.581.814L11 15m7 0a3 3 0 0 0 0-6M6 15h3v5H6v-5Z" />
                        </svg>
                        <span x-show="sidebarOpen">Announcement</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                    <span class="inline-flex items-center">
                        <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                        </svg>
                        <span x-show="sidebarOpen">Activities</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('clearances.index')" :active="request()->routeIs('clearances.*')">
                    <span class="inline-flex items-center">
                        <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                        </svg>
                        <span x-show="sidebarOpen">Clearance</span>
                    </span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('blotters.index')" :active="request()->routeIs('blotters.*')">
                    <span class="inline-flex items-center">
                        <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1"
                                d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z" />
                        </svg>
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