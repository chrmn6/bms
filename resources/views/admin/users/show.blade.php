@section('title') {{ 'Staff' }} @endsection

<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

        <!--PROFILE HEADER--->
        <div class="py-3 mt-2 border border-gray-300 bg-gray-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-4">
                <div class="flex items-start gap-6">
                    <!-- Image -->
                    <div
                        class="relative w-20 h-20 xl:w-28 xl:h-28 flex-shrink-0 overflow-hidden rounded-full shadow-md bg-neutral-50">
                        <img src="{{ asset('storage/uploads/users/' . $staff->image) }}" alt="{{ $staff->full_name }}"
                            class="w-full h-full object-cover">
                    </div>
                    <!-- Name + Position + Status -->
                    <div class="flex flex-col justify-center mt-3">
                        <div class="flex items-center gap-2">
                            <h5 class="text-lg font-semibold">{{ $staff->full_name }}</h5>
                            <a href="{{ route('admin.staff.index') }}"
                                class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                                #{{ $staff->display_id }}
                            </a>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-slate-500 dark:text-zinc-200 m-0">{{ ucfirst($staff->role) }}</p>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-500 dark:text-white flex-shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.3">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                @if ($staff->status === 'Active')
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
                        Dedicated staff member committed to supporting the operations and initiatives of the barangay.
                        Experienced in assisting
                        residents, managing administrative tasks, and ensuring smooth day-to-day activities. Skilled in
                        communication,
                        problem-solving, and teamwork, contributing to a positive and efficient working environment.
                        Trusted for reliability,
                        professionalism, and a strong commitment to serving the community.
                    </p>
                </div>
            </div>
        </div>

        <!--PERSONAL INFO--->
        <div class="py-3 mt-2 mb-2 border border-gray-300 bg-gray-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col">
                <h6 class="mb-4 text-15 text-gray-700">Personal Information</h6>
                <table class="w-full ltr:text-left rtl:ext-right">
                    <tbody>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Full Name</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $staff->full_name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Phone No</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $staff->phone_number }}
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Birth of Date</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">22 Aug, 1991</td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Email</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $staff->email }}
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Address</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">Barangay Matina Gravahan
                            </td>
                        </tr>
                        <tr>
                            <th class="pt-2 font-semibold ps-0 text-gray-700" scope="row">Joining Date</th>
                            <td class="pt-2 text-right text-slate-500 dark:text-zink-200">{{
                                $staff->created_at->format('m/d/Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>