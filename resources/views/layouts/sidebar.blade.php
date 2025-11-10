<!--NAVBAR-->
<nav class="fixed top-0 z-50 w-full bg-neutral-50 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-2 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <!-- LOGO -->
                <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24 !no-underline" style="color: #6D0512;">
                    <x-dashboard-logo class="h-8 me-3" alt="BMS Logo" />
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl !no-underline whitespace-nowrap dark:text-white">Barangay
                        Matina Gravahan</span>
                </a>
            </div>
            <!--PROFILE ADMIN AND STAFF--->
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl cursor-pointer border border-gray-300 bg-[#FAFAFA]"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img src="{{ asset('uploads/users/' . Auth::user()->image) }}"
                                alt="{{ Auth::user()->full_name }}" class="w-8 h-8 rounded-full">
                            <div class="flex flex-col leading-tight">
                                <span class="font-semibold text-sm text-gray-900">{{ Auth::user()->full_name }}</span>
                                <span class="text-sm text-gray-500">{{ ucfirst(Auth::user()->role) }}</span>
                            </div>
                        </button>
                    </div>
                    <div class="hidden text-base list-none" id="dropdown-user">
                        <ul role="none"
                            class="w-35 left-3 right-3 bg-white shadow-lg rounded-lg p-2 z-50 border border-gray-200">
                            <li>
                                <x-dropdown-link :href="route('profile.edit')"
                                    :active="request()->routeIs('profile.edit')">
                                    Profile
                                </x-dropdown-link>
                            </li>
                            <li>
                                <x-dropdown-link :href="route('settings.edit')"
                                    :active="request()->routeIs('settings.*')">
                                    Settings
                                </x-dropdown-link>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Sign Out
                                    </x-dropdown-link>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-52 h-screen pt-20 transition-transform -translate-x-full bg-neutral-50 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full overflow-y-auto bg-neutral-50 dark:bg-gray-800">
        <ul class="space-y-1 font-medium">
            @php $user = Auth::user(); @endphp
            <!--DASHBOARD-->
            <li>
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
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

            <!--Manage Users (Admin only)-->
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

                <li>
                    <x-sidebar-link :href="route('admin.officials.index')"
                        :active="request()->routeIs('admin.officials.index')">
                        <span class="inline-flex items-center">
                            <svg class="w-[20px] h-[20px] mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1"
                                    d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                            <span x-show="sidebarOpen">Officials</span>
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
        </ul>
    </div>
</aside>