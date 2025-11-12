@section('title') {{ 'Profile' }} @endsection

<x-resident-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <div>
                @include('residents.partials.update-profile-information-form')
            </div>
        </div>
    </div>
</x-resident-layout>