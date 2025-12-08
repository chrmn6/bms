@section('title') {{ 'Official' }} @endsection

<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <!--PROFILE HEADER--->
        <div class="py-3 mt-2 border border-gray-300 bg-gray-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-4">
                <div class="flex items-start gap-6">
                    <!-- Image -->
                    <div
                        class="relative w-20 h-20 xl:w-28 xl:h-28 flex-shrink-0 overflow-hidden rounded-full shadow-md bg-neutral-50">
                        <img src="{{ asset('storage/uploads/residents/' . $official->resident->profile->image) }}"
                            alt="{{ $official->resident->full_name }}" class="w-full h-full object-cover"
                            fetchpriority="high">
                    </div>
                    <!-- Name + Position + Status -->
                    <div class="flex flex-col justify-center mt-3">
                        <div class="flex items-center gap-2">
                            <h5 class="text-lg font-semibold">{{ $official->resident->full_name }}</h5>
                            <a href="{{ route('admin.officials.index') }}"
                                class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                                #{{ $official->display_id }}
                            </a>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-slate-500 dark:text-zinc-200 m-0">{{ $official->position }}</p>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-500 dark:text-white flex-shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                @if ($official->status === 'Active')
                                    <span class="text-green-500 font-semibold">Active</span>
                                @else
                                    <span class="text-red-500 font-semibold">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <p class="text-slate-500 dark:text-zinc-200">
                        Dedicated community leader and advocate committed to serving the needs of the barangay.
                        Experienced in public administration, local governance, and community engagement, with a
                        proven track record of implementing programs that improve the welfare of residents. Skilled
                        in fostering collaboration, resolving conflicts, and driving initiatives that promote growth,
                        safety, and sustainability. Trusted by constituents for integrity, transparency, and effective
                        decision-making.
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
                                    <td class="p-2">{{ $official->resident->full_name }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Middle Name</th>
                                    <td class="p-2">{{ $official->resident->middle_name ?: 'N/A' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Suffix</th>
                                    <td class="p-2">{{ $official->resident->suffix ?: 'N/A' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Gender</th>
                                    <td class="p-2">{{ $official->resident->profile->gender }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Date of Birth</th>
                                    <td class="p-2">{{ $official->resident->profile->date_of_birth?->format('m/d/Y') }}
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Phone Number</th>
                                    <td class="p-2">{{ $official->resident->user->phone_number }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="text-lg font-semibold mt-4">Address Information</p>
                        <table class="w-full text-sm border border-gray-300">
                            <tbody>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Phase Number</th>
                                    <td class="p-2">{{ $official->resident->phase->phase_number }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Household Number</th>
                                    <td class="p-2">{{ $official->resident->household->household_number }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Street Address</th>
                                    <td class="p-2">{{ $official->resident->address }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left font-semibold p-2">Place of Birth</th>
                                    <td class="p-2">{{ $official->resident->profile->place_of_birth }}</td>
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
                                    <td class="p-2">{{ $official->resident->user->email }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Civil Status</th>
                                    <td class="p-2">{{ $official->resident->details->civil_status }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Education</th>
                                    <td class="p-2">{{ $official->resident->details->education }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Citizenship</th>
                                    <td class="p-2">{{ $official->resident->details->citizenship }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Employment</th>
                                    <td class="p-2">{{ $official->resident->details->occupation }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <th class="text-left font-semibold p-2">Blood Type</th>
                                    <td class="p-2">{{ $official->resident->attributes->blood_type }}</td>
                                </tr>

                                <tr>
                                    <th class="text-left font-semibold p-2">Registered Voter</th>
                                    <td class="p-2">{{ $official->resident->attributes->voter_status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--PROJECTS--->
        <div
            class="py-3 mt-2 mb-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col">
                <div class="tab-pane block" id="projectsTabs">
                    <div class="flex items-center gap-3 mb-4">
                        <h5 class="text-gray-600 grow">Projects</h5>
                    </div>
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2 2xl:grid-cols-4">
                        @foreach($programs as $program)
                        <div class="card">
                            <div class="card-body bg-white-50">
                                <div class="flex">
                                    <div class="grow">
                                        <img src="{{ asset('storage/images/bms-logo.png') }}" alt="BMS LOGO"
                                            class="h-11" fetchpriority="high">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h6 class="mb-1 text-16">
                                        <a href="{{ route('admin.programs.index') }}">{{
                                            $program->title }}</a>
                                    </h6>
                                    <p class="text-slate-500 dark:text-zink-200">{{ $program->description }}</p>
                                </div>

                                <div
                                    class="flex w-full gap-3 mt-6 text-center divide-x divide-slate-200 dark:divide-zink-500 rtl:divide-x-reverse">
                                    <div class="px-3 grow">
                                        <h6 class="mb-1">{{ $program->application_end->format('d M, Y') }}</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Due Date</p>
                                    </div>
                                    <div class="px-3 grow">
                                        <h6 class="mb-1">
                                            ₱{{ number_format(optional($program->expense)->amount, 2) }}</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Budget</p>
                                    </div>
                                </div>
                                <div class="w-full h-1.5 mt-6 rounded-full bg-slate-100 dark:bg-zink-600">
                                    <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>