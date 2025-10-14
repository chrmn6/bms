<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Welcome back, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!
        </h2>
    </x-slot>

    @php
        $user = Auth::user();
        $resident = $user->resident;
        $profile = $resident?->profile;
        $household = $resident?->household;

        $isIncomplete = false;
        if (!$resident || !$profile || !$household) {
            $isIncomplete = true;
        } else {
            $requiredFields = [

                // residents table
                $resident->middle_name,
                $resident->suffix,
                $resident->place_of_birth,
                $resident->date_of_birth,
                $resident->gender,
                $resident->address,

                // residents profile
                $profile->civil_status,
                $profile->citizenship,
                $profile->occupation,
                $profile->education,

                //household
                $household->household_number,
            ];

            foreach ($requiredFields as $field) {
                if (empty($field)) {
                    $isIncomplete = true;
                    break;
                }
            }
        }
    @endphp

    <div class="py-3">
        @if ($isIncomplete)
            <div class="bg-yellow-100 border-yellow-500 text-yellow-700 p-4 mb-6 mx-6 rounded">
                <p class="font-bold">⚠️ Please complete your profile information</p>
                <p class="text-sm mb-2">
                    You need to complete your profile information first before fully accessing the system.
                </p>
                <a href="{{ route('residents.edit') }}"
                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Complete Profile
                </a>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" x-transition
            class="fixed top-10 px-6 py-3 rounded shadow-lg z-50"
            style="background-color: #16a34a; color: #ffffff; min-width: 200px; left: 50%; transform: translateX(-50%);">
            {{ session('success') }}
            <button @click="show = false" style="color: #ffffff;" class="ml-2 font-bold float-right">×</button>
        </div>
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ "KAPOY NAMAN" }}
                </div>
            </div>
        </div>

        <a href="{{ route('resident.barangay-clearance', $resident->resident_id) }}" class="btn btn-primary">Download
            Barangay Clearance</a>
        <a href="{{ route('resident.business-clearance', $resident->resident_id) }}" class="btn btn-primary">Download
            Business Clearance</a>
        <a href="{{ route('resident.residency-clearance', $resident->resident_id) }}" class="btn btn-primary">Download
            Residency Clearance</a>
    </div>
</x-app-layout>