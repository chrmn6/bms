<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 sticky top-0 h-screen w-64 flex flex-col">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="shrink-0 flex items-center justify-center px-4 py-6">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-grow px-4 space-y-1 overflow-y-auto">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="inline-flex items-center">
                    <ion-icon name="laptop-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span>Dashboard</span>
                </span>
            </x-nav-link>

            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <span class="inline-flex items-center">
                    <ion-icon name="person-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </span>
            </x-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.create')">
                    <span class="inline-flex items-center">
                        <ion-icon name="people-circle-outline" class="w-5 h-5 mr-6"></ion-icon>
                        <span>User Management</span>
                    </span>
                </x-nav-link>
            @endif

            @if(Auth::user()->role === 'admin')
                <x-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.create')">
                    <span class="inline-flex items-center">
                        <ion-icon name="people-outline" class="w-5 h-5 mr-6"></ion-icon>
                        <span>Resident List</span>
                    </span>
                </x-nav-link>
            @endif

            <x-nav-link :href="route('activities')" :active="request()->routeIs('activities')">
                <span class="inline-flex items-center">
                    <ion-icon name="globe-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span class>Activity</span>
                </span>
            </x-nav-link>
            <x-nav-link :href="route('announcement')" :active="request()->routeIs('announcement')">
                <span class="inline-flex items-center">
                    <ion-icon name="megaphone-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span>Announcement</span>
                </span>
            </x-nav-link>
            <x-nav-link :href="route('clearance')" :active="request()->routeIs('clearance')">
                <span class="inline-flex items-center">
                    <ion-icon name="reader-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span>Clearance</span>
                </span>
            </x-nav-link>
            <x-nav-link :href="route('blotter')" :active="request()->routeIs('blotter')">
                <span class="inline-flex items-center">
                    <ion-icon name="newspaper-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span>Blotter Report</span>
                </span>
            </x-nav-link>
            <x-nav-link :href="route('emergency')" :active="request()->routeIs('emergency')">
                <span class="inline-flex items-center">
                    <ion-icon name="call-outline" class="w-5 h-5 mr-6"></ion-icon>
                    <span>Contact Info</span>
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
        </div>
    </div>
</nav>