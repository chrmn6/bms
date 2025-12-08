@section('title') {{ 'Resident' }} @endsection

<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <!--PROFILE HEADER-->
        <div class="py-3 mt-2 border border-gray-300 bg-gray-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-4">
                <div class="flex items-start gap-6">
                    <!-- Image -->
                    <div
                        class="relative w-20 h-20 xl:w-28 xl:h-28 flex-shrink-0 overflow-hidden rounded-full shadow-md bg-neutral-50">
                        <img src="{{ asset('storage/uploads/residents/' . $resident->profile->image) }}"
                            alt="{{ $resident->full_name }}" class="w-full h-full object-cover" fetchpriority="high">
                    </div>

                    <!-- Name + ID + Status -->
                    <div class="flex flex-col justify-center mt-3">
                        <div class="flex items-center gap-2">
                            <h5 class="text-lg font-semibold">{{ $resident->full_name }}</h5>
                            <a href="{{ route('admin.resident.index') }}"
                                class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                                #{{ $resident->display_id }}
                            </a>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-slate-500 dark:text-zinc-200 m-0">{{ $resident->user->email }}
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-slate-500 dark:text-zinc-200">
                        Resident of Barangay Matina Gravahan. Details about personal, address, and additional
                        information are provided below for administrative and community purposes.
                    </p>
                </div>
            </div>
        </div>

        <!--PERSONAL & ADDRESS INFO-->
        <div class="py-3 mt-2 mb-2 border border-gray-300 bg-gray-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- LEFT COLUMN -->
                    <div class="space-y-4">
                        <p class="text-lg font-semibold">Basic Information</p>
                        <table class="w-full text-sm border border-gray-300">
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Full Name</th>
                                    <td class="p-2">{{ $resident->full_name }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Middle Name</th>
                                    <td class="p-2">{{ $resident->middle_name ?: 'N/A' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Suffix</th>
                                    <td class="p-2">{{ $resident->suffix ?: 'N/A' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Gender</th>
                                    <td class="p-2">{{ $resident->profile->gender }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Date of Birth</th>
                                    <td class="p-2">{{ $resident->profile->date_of_birth?->format('m/d/Y') }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Phone Number</th>
                                    <td class="p-2">{{ $resident->user->phone_number }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="text-lg font-semibold mt-4">Address Information</p>
                        <table class="w-full text-sm border border-gray-300">
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Phase Number</th>
                                    <td class="p-2">{{ $resident->phase->phase_number }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Household Number</th>
                                    <td class="p-2">{{ $resident->household->household_number }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Street Address</th>
                                    <td class="p-2">{{ $resident->address }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left font-semibold p-2">Place of Birth</th>
                                    <td class="p-2">{{ $resident->profile->place_of_birth }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="space-y-4">
                        <p class="text-lg font-semibold">Additional Information</p>
                        <table class="w-full text-sm border border-gray-300">
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Email Address</th>
                                    <td class="p-2">{{ $resident->user->email }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Civil Status</th>
                                    <td class="p-2">{{ $resident->details->civil_status }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Education</th>
                                    <td class="p-2">{{ $resident->details->education }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Citizenship</th>
                                    <td class="p-2">{{ $resident->details->citizenship }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Employment</th>
                                    <td class="p-2">{{ $resident->details->occupation }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Blood Type</th>
                                    <td class="p-2">{{ $resident->attributes->blood_type }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Registered Voter</th>
                                    <td class="p-2">{{ $resident->attributes->voter_status }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left font-semibold p-2">Official</th>
                                    <td class="p-2">
                                        @if($resident->official)
                                            <span class="text-sm font-semibold text-[#6D0512] ">
                                                {{ $resident->official->position }}
                                            </span>
                                        @else
                                            <span class="text-sm font-semibold text-[#6D0512]">
                                                Resident
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>