<div class="col-lg-12">
    <div class="card-body">
        <!-- Profile Section -->
        <div class="d-flex flex-column align-items-center text-center">
            @php
                $hasImage = $resident->profile->image && !empty($resident->profile->image) &&
                    file_exists(public_path('uploads/residents/' . $resident->profile->image));
            @endphp

            @if($hasImage)
                <img src="{{ asset('uploads/residents/' . $resident->profile->image) }}" alt="Profile Photo"
                    class="rounded-circle"
                    style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #6D0512;">
            @else
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #6D0512, #8B4513); border: 3px solid #8B4512;">
                    <i class="bi bi-person text-white" style="font-size: 4rem; line-height: 1;"></i>
                </div>
            @endif

            <p class="text-lg fw-semibold mb-0">
                {{ $resident->full_name }}<br>
            </p>
        </div>

        <!-- Info Section -->
        <div class="row mt-3">
            <!-- LEFT COLUMN -->
            <div class="col-md-6 space-y-4">
                <!-- Basic Information -->
                <div>
                    <p class="text-lg fw-semibold mb-2">Basic Information</p>
                    <table class="w-full border border-gray-300 text-sm">
                        <tbody>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Full Name</th>
                                <td>{{ $resident->full_name }}</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Middle Name</th>
                                <td>{{ $resident->middle_name ?: 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Suffix</th>
                                <td>{{ $resident->suffix ?: 'N/A' }}</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Gender</th>
                                <td>{{ $resident->profile->gender }}</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Date of Birth</th>
                                <td>{{ $resident->profile->date_of_birth?->format('m/d/y') }}</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Phone Number</th>
                                <td>{{ $resident->user->phone_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Address Info -->
                <div class="mb-3">
                    <p class="text-lg fw-semibold mb-2">Address Information</p>
                    <table class="w-full border border-gray-300 text-sm">
                        <tbody>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Household Number</th>
                                <td>{{ $resident->household->household_number }}</td>
                            </tr>
                            <tr class="border-b border-gray-300">
                                <th class="text-left font-semibold p-2">Street Address</th>
                                <td>{{ $resident->address }}</td>
                            </tr>
                            <tr>
                                <th class="text-left font-semibold p-2">Place of Birth</th>
                                <td>{{ $resident->profile->place_of_birth }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-md-6">
                <p class="text-lg fw-semibold mb-2">Additional Information</p>
                <table class="w-full border border-gray-300 text-sm">
                    <tbody>
                        <tr class="border-b border-gray-300">
                            <th class="text-left font-semibold p-2">Email Address</th>
                            <td>{{ $resident->user->email }}</td>
                        </tr>
                        <tr class="border-b border-gray-300">
                            <th class="text-left font-semibold p-2">Civil Status</th>
                            <td>{{ $resident->details->civil_status }}</td>
                        </tr>
                        <tr class="border-b border-gray-300">
                            <th class="text-left font-semibold p-2">Education</th>
                            <td>{{ $resident->details->education }}</td>
                        </tr>
                        <tr class="border-b border-gray-300">
                            <th class="text-left font-semibold p-2">Citizenship</th>
                            <td>{{ $resident->details->citizenship }}</td>
                        </tr>
                        <tr>
                            <th class="text-left font-semibold p-2">Employment</th>
                            <td>{{ $resident->details->occupation }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>