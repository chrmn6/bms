<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <form method="POST" action="{{ route('residents.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!--PROFILE HEADER-->
        <div class="py-3 mt-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col items-center text-center">
                <!-- Profile Picture -->
                <label for="image" class="relative cursor-pointer group d-block text-center">
                    @if ($resident->profile?->image)
                        <img id="profilePreview" src="{{ asset('uploads/residents/' . $resident->profile->image) }}"
                            class="rounded-circle" alt="Profile Photo"
                            style="width: 110px; height: 110px; object-fit: cover; border: 2px solid #6D0512; margin-bottom: 4px;">
                    @else
                        <img id="profilePreview" src="{{ asset('images/default-avatar.jpg') }}" class="rounded-circle"
                            alt="Default Profile Photo"
                            style="width: 110px; height: 110px; object-fit: cover; border: 2px solid #6D0512; margin-bottom: 4px;">
                    @endif
                    <input type="file" name="image" id="image" class="d-none">
                </label>

                <!-- Name + Display ID -->
                <div class="flex items-baseline justify-center gap-1" style="margin-bottom: 2px;">
                    <h5 class="text-lg font-semibold m-0">{{ $resident->full_name }}</h5>
                    <p class="text-sm text-blue-600 dark:text-blue-400 m-0">
                        #{{ $resident->display_id }}
                    </p>
                </div>

                <!-- Joined Date -->
                <p class="text-sm text-slate-500 dark:text-zinc-300 m-0">
                    Joined on {{ $resident->created_at->format('d, F Y') }}
                </p>
            </div>
        </div>

        <!--PERSONAL & ADDRESS INFO-->
        <div
            class="py-3 mt-2 mb-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-2 bg-neutral-50">
                <div>
                    <p class="text-lg font-semibold mb-1">Basic Information</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!-- FIRST NAME -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="first_name" :value="__('First Name')" />
                                    </th>
                                    <td>
                                        <x-text-input id="first_name" name="first_name" type="text"
                                            class="mt-2 block w-full" :value="old('first_name', $user->first_name)"
                                            required placeholder="Provide your first name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                    </td>
                                </tr>

                                <!-- LAST NAME -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="last_name" :value="__('Last Name')" />
                                    </th>
                                    <td>
                                        <x-text-input id="last_name" name="last_name" type="text"
                                            class="mt-2 block w-full" :value="old('last_name', $user->last_name)"
                                            required placeholder="Provide your last name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                    </td>
                                </tr>

                                <!-- MIDDLE NAME -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" />
                                    </th>
                                    <td>
                                        <x-text-input id="middle_name" name="middle_name" type="text"
                                            class="mt-2 block w-full" :value="old('middle_name', $resident->middle_name ?? '')" placeholder="Provide your middle name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                                    </td>
                                </tr>

                                <!-- SUFFIX -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="suffix" :value="__('Suffix')" />
                                    </th>
                                    <td>
                                        <select id="suffix" name="suffix"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">N/A</option>
                                            <option value="Jr." {{ old('suffix', $resident->suffix ?? '') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                            <option value="Sr." {{ old('suffix', $resident->suffix ?? '') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                            <option value="III" {{ old('suffix', $resident->suffix ?? '') == 'III' ? 'selected' : '' }}>III</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!-- GENDER -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="gender" :value="__('Gender')" />
                                    </th>
                                    <td>
                                        <select id="gender" name="gender"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ old('gender', $resident->profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $resident->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                    </td>
                                </tr>

                                <!--CIVIL STATUS-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="civil_status" :value="__('Civil Status')" />
                                    </th>
                                    <td>
                                        <select id="civil_status" name="civil_status"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select Civil Status</option>
                                            <option value="Single" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Single' ? 'selected' : '' }}>
                                                Single</option>
                                            <option value="In A Relationship" {{ old('civil_status', $resident->details->civil_status ?? '') == 'In A Relationship' ? 'selected' : '' }}>In A Relationship</option>
                                            <option value="Married" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Married' ? 'selected' : '' }}>
                                                Married</option>
                                            <option value="Widowed" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>
                                                Widowed</option>
                                            <option value="Divorced" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
                                    </td>
                                </tr>

                                <!-- DATE OF BIRTH -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                    </th>
                                    <td>
                                        <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                                            class="mt-2 block w-full" :value="old('date_of_birth', $resident->profile->date_of_birth ? $resident->profile->date_of_birth->format('Y-m-d') : '')" />
                                        <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                                    </td>
                                </tr>

                                <!-- PHONE NUMBER -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                                    </th>
                                    <td>
                                        <x-text-input id="phone_number" name="phone_number" type="text"
                                            class="mt-2 block w-full" :value="old('phone_number', $user->phone_number)"
                                            required placeholder="Provide your number" />
                                        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADDRESS INFO-->
        <div
            class="py-3 mt-2 mb-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-2 bg-neutral-50">
                <div>
                    <p class="text-lg font-semibold mb-1">Address Information</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!--HOUSEHOLD NUMBER-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="household_id" :value="__('Household')" />
                                    </th>
                                    <td>
                                        <select id="household_id" name="household_id"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select Household</option>
                                            @foreach($households as $household)
                                                <option value="{{ $household->household_id }}" {{ $resident->household_id == $household->household_id ? 'selected' : '' }}>
                                                    {{ $household->household_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('household_id')" />
                                    </td>
                                </tr>
                                <!--STREET ADDRESS-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="address" :value="__('Address')" />
                                    </th>
                                    <td>
                                        <x-text-input id="address" name="address" type="text" class="mt-2 block w-full"
                                            :value="old('address', $resident->address ?? '')"
                                            placeholder="Provide your address" />
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!--PLACE OF BIRTH-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                                    </th>
                                    <td>
                                        <x-text-input id="place_of_birth" name="place_of_birth" type="text"
                                            class="mt-2 block w-full" :value="old('place_of_birth', $resident->profile->place_of_birth ?? '')"
                                            placeholder="Provide your place of birth" />
                                        <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADDITIONAL INFO-->
        <div
            class="py-3 mt-2 mb-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-2 bg-neutral-50">
                <div>
                    <p class="text-lg font-semibold mb-1">Additional Information</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!--EMAIL-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="email" :value="__('Email')" />
                                    </th>
                                    <td>
                                        <x-text-input id="email" name="email" type="email" class="mt-2 block w-full"
                                            :value="old('email', $user->email)" required autocomplete="username" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                            <div class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                                                {{ __('Your email address is unverified.') }}
                                                <button form="send-verification"
                                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                    {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                            </div>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <!--EDUCATION-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="education" :value="__('Education')" />
                                    </th>
                                    <td>
                                        <select id="education" name="education"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select Education Level</option>
                                            <option value="Elementary" {{ old('education', $resident->details->education ?? '') == 'Elementary' ? 'selected' : '' }}>
                                                Elementary</option>
                                            <option value="High School" {{ old('education', $resident->details->education ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                                            <option value="Vocational/Technical" {{ old('education', $resident->details->education ?? '') == 'Vocational/Technical' ? 'selected' : '' }}>Vocational/Technical
                                            </option>
                                            <option value="College" {{ old('education', $resident->details->education ?? '') == 'College' ? 'selected' : '' }}>
                                                College</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('education')" />
                                    </td>
                                </tr>
                                <!--OCCUPATION-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="occupation" :value="__('Employment')" />
                                    </th>
                                    <td>
                                        <select id="occupation" name="occupation"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select Employment Status</option>
                                            <option value="Self-Employed" {{ old('occupation', $resident->details->occupation ?? '') == 'Self-Employed' ? 'selected' : '' }}>
                                                Self-Employed</option>
                                            <option value="Unemployed" {{ old('occupation', $resident->details->occupation ?? '') == 'Unemployed' ? 'selected' : '' }}>Unemployed</option>
                                            <option value="Employed" {{ old('occupation', $resident->details->occupation ?? '') == 'Employed' ? 'selected' : '' }}>Employed
                                            </option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!--CITIZENSHIP-->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="citizenship" :value="__('Nationality')" />
                                    </th>
                                    <td>
                                        <x-text-input id="citizenship" name="citizenship" type="text"
                                            class="mt-2 block w-full" :value="old('citizenship', $resident->details->citizenship ?? '')"
                                            placeholder="Provide your citizenship" />
                                        <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                                    </td>
                                </tr>

                                <!-- BLOOD TYPE -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="blood_type" :value="__('Blood Type')" />
                                    </th>
                                    <td>
                                        <x-text-input id="blood_type" name="blood_type" type="text" class="mt-2 block w-full"
                                            :value="old('blood_type', $resident->attributes->blood_type ?? '')"
                                            placeholder="e.g. A+, O-, B+" />
                                        <x-input-error class="mt-2" :messages="$errors->get('blood_type')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ADDITIONAL INFO-->
        <div
            class="py-3 mt-2 mb-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
            <div class="card-body !px-2.5 flex flex-col gap-2 bg-neutral-50">
                <div>
                    <p class="text-lg font-semibold mb-1">Government Information</p>
                    <p class="text-sm text-slate-500 mb-1">This section is for your government-related details.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!-- VOTER STATUS -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="voter_status" :value="__('Registered Voter')" />
                                    </th>
                                    <td>
                                        <select id="voter_status" name="voter_status"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select</option>
                                            <option value="No" {{ old('voter_status', $resident->attributes->voter_status ?? '') == 'No' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="Yes" {{ old('voter_status', $resident->attributes->voter_status ?? '') == 'Yes' ? 'selected' : '' }}>
                                                No</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('voter_status')" />
                                    </td>
                                </tr>

                                <!-- PWD STATUS -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="pwd_status" :value="__('Person with Disability (PWD)')" />
                                    </th>
                                    <td>
                                        <select id="pwd_status" name="pwd_status"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select</option>
                                            <option value="No" {{ old('pwd_status', $resident->attributes->pwd_status ?? '') == 'No' ? 'selected' : '' }}>Yes</option>
                                            <option value="Yes" {{ old('pwd_status', $resident->attributes->pwd_status ?? '') == 'Yes' ? 'selected' : '' }}>No</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('pwd_status')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
                                <!-- SENIOR STATUS -->
                                <tr>
                                    <th class="text-left font-semibold p-2">
                                        <x-input-label for="senior" :value="__('Senior Citizen')" />
                                    </th>
                                    <td>
                                        <select id="senior" name="senior"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                            <option value="">Select</option>
                                            <option value="No" {{ old('senior', $resident->attributes->senior ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                            <option value="Yes" {{ old('senior', $resident->attributes->senior ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('senior')" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--SUBMIT BUTTON-->
        <div class="mt-3 flex justify-end">
            <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                Save Changes
            </x-primary-button>
        </div>
    </form>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('profilePreview');
            const uploadText = document.getElementById('uploadText');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                uploadText.classList.add('hidden');
            }
        });
    </script>
</div>