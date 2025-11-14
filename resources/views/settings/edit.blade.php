@section('title') {{ 'Settings' }} @endsection

@php
    $layout = auth()->user()->role === 'resident' ? 'resident-layout' : 'app-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class="py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    @include('settings.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    @include('settings.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>