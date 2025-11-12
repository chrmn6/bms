@section('title') {{ 'Profile' }} @endsection

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>
</x-app-layout>