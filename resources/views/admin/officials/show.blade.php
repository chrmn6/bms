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
                        <img src="{{ asset('storage/uploads/users/' . $official->image) }}"
                            alt="{{ $official->full_name }}" class="w-full h-full object-cover">
                    </div>
                    <!-- Name + Position + Status -->
                    <div class="flex flex-col justify-center mt-3">
                        <div class="flex items-center gap-2">
                            <h5 class="text-lg font-semibold">{{ $official->full_name }}</h5>
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

        <!--PERSONAL INFO--->
        <div class="py-3 mt-2 mb-2 border border-gray-300 bg-gray-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col">
                <h6 class="mb-4 text-15 text-gray-700">Personal Information</h6>
                <table class="w-full ltr:text-left rtl:ext-right">
                    <tbody>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Full Name</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $official->full_name }}
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Phone No</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">09101112134</td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Birth of Date</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">22 Aug, 1991</td>
                        </tr>
                        <tr>
                            <th class="py-2 font-semibold ps-0 text-gray-700" scope="row">Email</th>
                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">barangayofficial@gmail.com
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
                                $official->created_at->format('m/d/Y') }}</td>
                        </tr>
                    </tbody>
                </table>
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
                        <div class="card">
                            <div class="card-body bg-white-50">
                                <div class="flex">
                                    <div class="grow">
                                        <img src="storage/images/bms-logo.png" alt="" class="h-11">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h6 class="mb-1 text-16"><a href="#!">Community Health and Wellness Program</a></h6>
                                    <p class="text-slate-500 dark:text-zink-200">To promote preventive healthcare and
                                        ensure accessible medical support for all residents.</p>
                                </div>
                                <div
                                    class="flex w-full gap-3 mt-6 text-center divide-x divide-slate-200 dark:divide-zink-500 rtl:divide-x-reverse">
                                    <div class="px-3 grow">
                                        <h6 class="mb-1">20 Oct, 2023</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Completed</p>
                                    </div>
                                    <div class="px-3 grow">
                                        <h6 class="mb-1">₱43,000.00</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Budget</p>
                                    </div>
                                </div>
                                <div class="w-full h-1.5 mt-6 rounded-full bg-slate-100 dark:bg-zink-600">
                                    <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
                                </div>
                            </div>
                        </div><!--end card & col-->
                        <div class="card">
                            <div class="card-body bg-white-50">
                                <div class="flex">
                                    <div class="grow">
                                        <img src="storage/images/bms-logo.png" alt="" class="h-11">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h6 class="mb-1 text-16"><a href="#!">Barangay Clean and Green Initiative</a></h6>
                                    <p class="text-slate-500 dark:text-zink-200">Promote environmental awareness and
                                        maintain a clean, sustainable community.</p>
                                </div>
                                <div
                                    class="flex w-full gap-3 mt-6 text-center divide-x divide-slate-200 dark:divide-zink-500 rtl:divide-x-reverse">
                                    <div class="px-3 grow">
                                        <h6 class="mb-1">07 Dec, 2023</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Due Date</p>
                                    </div>
                                    <div class="px-3 grow">
                                        <h6 class="mb-1">₱27,000</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Budget</p>
                                    </div>
                                </div>
                                <div class="w-full h-1.5 mt-6 rounded-full bg-slate-100 dark:bg-zink-600">
                                    <div class="h-1.5 bg-purple-500 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>