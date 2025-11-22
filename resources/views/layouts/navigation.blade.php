<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('residents.dashboard') }}">
                        <x-dashboard-logo class="block h-7 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:-my-px sm:ms-10 sm:flex gap-x-4">
                    <x-resident-nav-link :href="route('residents.dashboard')"
                        :active="request()->routeIs('residents.dashboard')">
                        <span>Dashboard</span>
                    </x-resident-nav-link>

                    <x-resident-nav-link :href="route('announcements.index')"
                        :active="request()->routeIs('announcements.index')">
                        <span>Announcements</span>
                    </x-resident-nav-link>

                    <x-resident-nav-link :href="route('programs.index')" :active="request()->routeIs('programs.index')">
                        <span>Programs</span>
                    </x-resident-nav-link>

                    <x-resident-nav-link :href="route('activities.index')"
                        :active="request()->routeIs('activities.index')">
                        <span>Activities</span>
                    </x-resident-nav-link>

                    <x-resident-nav-link :href="route('clearances.index')"
                        :active="request()->routeIs('clearances.index')">
                        <span>Clearance</span>
                    </x-resident-nav-link>

                    <x-resident-nav-link :href="route('blotters.index')" :active="request()->routeIs('blotters.index')">
                        <span>Blotter</span>
                    </x-resident-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Notification Bell -->
                <a href="{{ route('residents.notifications.index') }}"
                    class="relative rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none me-4">
                    <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="m10.827 5.465-.435-2.324m.435 2.324a5.338 5.338 0 0 1 6.033 4.333l.331 1.769c.44 2.345 2.383 2.588 2.6 3.761.11.586.22 1.171-.31 1.271l-12.7 2.377c-.529.099-.639-.488-.749-1.074C5.813 16.73 7.538 15.8 7.1 13.455c-.219-1.169.218 1.162-.33-1.769a5.338 5.338 0 0 1 4.058-6.221Zm-7.046 4.41c.143-1.877.822-3.461 2.086-4.856m2.646 13.633a3.472 3.472 0 0 0 6.728-.777l.09-.5-6.818 1.277Z" />
                    </svg>

                    @php
                        $unreadCount = Auth::user()->unreadNotifications->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->full_name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('residents.edit')">
                            <span>Profile</span>
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('settings.edit')">
                            <span>Settings</span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <span>Sign Out</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <!-- Mobile Notification Bell -->
                <a href="{{ route('residents.notifications.index') }}"
                    class="relative flex items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6 text-gray-600 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="m10.827 5.465-.435-2.324m.435 2.324a5.338 5.338 0 0 1 6.033 4.333l.331 1.769c.44 2.345 2.383 2.588 2.6 3.761.11.586.22 1.171-.31 1.271l-12.7 2.377c-.529.099-.639-.488-.749-1.074C5.813 16.73 7.538 15.8 7.1 13.455c-.219-1.169.218 1.162-.33-1.769a5.338 5.338 0 0 1 4.058-6.221Zm-7.046 4.41c.143-1.877.822-3.461 2.086-4.856m2.646 13.633a3.472 3.472 0 0 0 6.728-.777l.09-.5-6.818 1.277Z" />
                    </svg>

                    @php
                        $unreadCount = Auth::user()->unreadNotifications->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span
                            class="absolute -top-1 -right-1 bg-red-600 text-white text-xs w-4 h-4 flex items-center justify-center rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <!-- Hamburger Button -->
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-3 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('residents.dashboard')"
                :active="request()->routeIs('residents.dashboard')">
                <span>Dashboard</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('announcements.index')"
                :active="request()->routeIs('announcements.index')">
                <span>Announcements</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('programs.index')" :active="request()->routeIs('programs.index')">
                <span>Programs</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                <span>Activities</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('clearances.index')" :active="request()->routeIs('clearances.index')">
                <span>Clearance</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('blotters.index')" :active="request()->routeIs('blotters.index')">
                <span>Blotter</span>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pb-1 border-gray-200">
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('residents.edit')">
                    <span>Profile</span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('settings.edit')">
                    <span>Settings</span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span>Sign Out</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>