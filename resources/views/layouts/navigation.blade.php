<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 sticky top-0 h-screen w-64 flex flex-col">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="shrink-0 flex items-center justify-center px-4 py-6">
            @php
                $user = Auth::user();
            @endphp
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

        <!-- Navigation Links -->
        <div class="flex-grow px-4 space-y-1 overflow-y-auto">
            <!-- ROLE BASED NAVIGATION FOR ALL USERS-->
            @if ($user)
                @if ($user->role === 'admin')
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <span class="inline-flex items-center">
                            <ion-icon name="stats-chart-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Dashboard</span>
                        </span>
                    </x-nav-link>
                @elseif ($user->role === 'staff')
                    <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
                        <span class="inline-flex items-center">
                            <ion-icon name="stats-chart-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Dashboard</span>
                        </span>
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('residents.dashboard')" :active="request()->routeIs('residents.dashboard')">
                        <span class="inline-flex items-center">
                            <ion-icon name="stats-chart-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Dashboard</span>
                        </span>
                    </x-nav-link>
                @endif

                {{-- Profile Link based on Role --}}
                @if ($user->role === 'admin' || $user->role === 'staff')
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                        <span class="inline-flex items-center">
                            <ion-icon name="person-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Profile</span>
                        </span>
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('residents.edit')" :active="request()->routeIs('residents.edit')">
                        <span class="inline-flex items-center">
                            <ion-icon name="person-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Profile</span>
                        </span>
                    </x-nav-link>
                @endif

                <!-- ADMIN ROUTE FOR CREATING A STAFF ACCOUNT-->
                @if($user->role === 'admin')
                    <x-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.index')">
                        <span class="inline-flex items-center">
                            <ion-icon name="people-circle-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Manage Users</span>
                        </span>
                    </x-nav-link>
                    <x-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.index')">
                        <span class="inline-flex items-center">
                            <ion-icon name="people-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Resident List</span>
                        </span>
                    </x-nav-link>
                @endif

                <!-- Other links -->

                <x-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.index')">
                    <span class="inline-flex items-center">
                        <ion-icon name="megaphone-outline" class="w-5 h-5 mr-6"></ion-icon>
                        <span>Announcement</span>
                    </span>
                </x-nav-link>

                <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                    <span class="inline-flex items-center">
                        <ion-icon name="globe-outline" class="w-5 h-5 mr-6"></ion-icon>
                        <span>Activities</span>
                    </span>
                </x-nav-link>

                <x-nav-link :href="route('clearance.index')" :active="request()->routeIs('clearance.*')">
                    <span class="inline-flex items-center">
                        <ion-icon name="reader-outline" class="w-5 h-5 mr-6"></ion-icon>
                        <span>Clearance</span>
                    </span>
                </x-nav-link>

                <x-nav-link :href="route('blotters.index')" :active="request()->routeIs('blotters.*')">
                    <span class="inline-flex items-center">
                        <ion-icon name="newspaper-outline" class="w-5 h-5 mr-6"></ion-icon>
                        <span>Blotter Report</span>
                    </span>
                </x-nav-link>

                <!-- Logout Link -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <x-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="inline-flex items-center">
                            <ion-icon name="log-out-outline" class="w-5 h-5 mr-6"></ion-icon>
                            <span>Sign Out</span>
                        </span>
                    </x-nav-link>
                </form>
            @endif
        </div>
    </div>
</nav>