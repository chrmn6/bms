@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

<section>
    <!-- Details Card -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle"></i> Personal Information
                </h5>
            </div>
            <div class="card-body bg-[#FAFAFA]">
                <form method="POST" action="{{ route('residents.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="d-flex flex-column align-items-center text-center">
                        <!-- Profile Picture -->
                        <label for="image" class="relative cursor-pointer group d-block text-center">
                            @if ($resident->profile?->image)
                                <img id="profilePreview" src="{{ asset('uploads/residents/' . $resident->profile->image) }}"
                                    class="rounded-circle mb-2" alt="Profile Photo"
                                    style="width: 110px; height: 110px; object-fit: cover; border: 2px solid #6D0512;">
                                <span id="uploadText" class="hidden text-gray-500 text-sm">Upload Photo</span>
                            @else
                                <img id="profilePreview" src="{{ asset('images/default-avatar.jpg') }}"
                                    class="rounded-circle mb-2" alt="Default Profile Photo"
                                    style="width: 110px; height: 110px; object-fit: cover; border: 2px solid #6D0512;">
                                <span id="uploadText" class="text-gray-500 text-sm">Upload Photo</span>
                            @endif

                            <input type="file" name="image" id="image" class="d-none">
                        </label>
                    </div>

                    <div class="row mt-3">
                        <!-- LEFT COLUMN -->
                        <div class="col-md-6 space-y-4">
                            <!-- Basic Information -->
                            <div>
                                <p class="text-lg fw-semibold mb-2">Basic Information</p>
                                <table class="text-sm w-full">
                                    <tbody>
                                        <!--FIRST NAME-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="first_name" :value="__('First Name')" />
                                            </th>
                                            <td>
                                                <x-text-input id="first_name" name="first_name" type="text"
                                                    class="mt-2 block w-full" :value="old('first_name', $user->first_name)" required
                                                    placeholder="Provide your first name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                            </td>
                                        </tr>
                                        <!--LAST NAME-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="last_name" :value="__('Last Name')" />
                                            </th>
                                            <td>
                                                <x-text-input id="last_name" name="last_name" type="text"
                                                    class="mt-2 block w-full" :value="old('last_name', $user->last_name)" required placeholder="Provide your last name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                            </td>
                                        </tr>
                                        <!--MIDDLE NAME-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" />
                                            </th>
                                            <td>
                                                <x-text-input id="middle_name" name="middle_name" type="text"
                                                    class="mt-2 block w-full" :value="old('middle_name', $resident->middle_name ?? '') "
                                                    placeholder="Provide your middle name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                                            </td>
                                        </tr>
                                        <!--SUFFIX NAME-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="suffix" :value="__('Suffix')" />
                                            </th>
                                            <td>
                                                <select id="suffix" name="suffix"
                                                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                                    <option value="">N/A</option>
                                                    <option value="Jr." {{ old('suffix', $resident->suffix ?? '') == 'Jr.' ? 'selected' : '' }}>
                                                        Jr.
                                                    </option>
                                                    <option value="Sr." {{ old('suffix', $resident->suffix ?? '') == 'Sr.' ? 'selected' : '' }}>
                                                        Sr.
                                                    </option>
                                                    <option value="III" {{ old('suffix', $resident->suffix ?? '') == 'III' ? 'selected' : '' }}>
                                                        III
                                                    </option>
                                                </select>
                                                <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
                                            </td>
                                        </tr>
                                        <!--GENDER-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="gender" :value="__('Gender')" />
                                            </th>
                                            <td>
                                                <select id="gender" name="gender"
                                                    class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" {{ old('gender', $resident->profile->gender ?? '') == 'Male' ? 'selected' : ''}}>Male</option>
                                                    <option value="Female" {{ old('gender', $resident->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                            </td>
                                        </tr>
                                        <!--DATE OF BIRTH-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                            </th>
                                            <td>
                                                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-2 block w-full" :value="old('date_of_birth', $resident->profile->date_of_birth ? $resident->profile->date_of_birth->format('Y-m-d') : '')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                                            </td>
                                        </tr>
                                        <!--PHONE NUMBER-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="phone_number" :value="__('Phone Number')" />
                                            </th>
                                            <td>
                                                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-2 block w-full"
                                                    :value="old('phone_number', $user->phone_number)" required
                                                    placeholder="Provide your number" />
                                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6 space-y-4">
                            <!-- Additional Information -->
                            <div>
                                <p class="text-lg fw-semibold mb-2">Additional Information</p>
                                <table class="text-sm w-full">
                                    <tbody>
                                        <!--EMAIL-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="email" :value="__('Email')" />
                                            </th>
                                            <td>
                                                <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $user->email)"
                                                    required autocomplete="username" />
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
                                        <!--CIVIL STATUS-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="civil_status" :value="__('Civil Status')" />
                                            </th>
                                            <td>
                                                <select id="civil_status" name="civil_status" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                                    <option value="">Select Civil Status</option>
                                                    <option value="Single" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                                    <option value="In A Relationship" {{ old('civil_status', $resident->details->civil_status ?? '') == 'In A Relationship' ? 'selected' : '' }}>In A Relationship</option>
                                                    <option value="Married" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                                                    <option value="Widowed" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                                    <option value="Divorced" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                                </select>
                                                <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
                                            </td>
                                        </tr>
                                        <!--EDUCATION-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="education" :value="__('Education')" />
                                            </th>
                                            <td>
                                                <select id="education" name="education" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
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
                                        <!--CITIZENSHIP-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="citizenship" :value="__('Citizenship')" />
                                            </th>
                                            <td>
                                                <x-text-input id="citizenship" name="citizenship" type="text" class="mt-2 block w-full"
                                                    :value="old('citizenship', $resident->details->citizenship ?? '')"
                                                    placeholder="Provide your citizenship" />
                                                <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                                            </td>
                                        </tr>
                                        <!--OCCUPATION-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="occupation" :value="__('Employment')" />
                                            </th>
                                            <td>
                                                <select id="occupation" name="occupation" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
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
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- BOTTOM COLUMN -->
                        <div class="col-md-6 space-y-4">
                            <!-- Address Information -->
                            <div>
                                <p class="text-lg fw-semibold mb-2">Address Information</p>
                                <table class="text-sm w-full">
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
                                        <!--HOUSEHOLD NUMBER-->
                                        <tr>
                                            <th class="text-left font-semibold p-2">
                                                <x-input-label for="household_id" :value="__('Household')" />
                                            </th>
                                            <td>
                                                <select id="household_id" name="household_id" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
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
                        </div>
                    </div>

                    <!--SUBMIT BUTTON-->
                    <div class="mt-3 flex justify-end">
                        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                            Save Changes
                        </x-primary-button>
                    </div>
                </form>
            </div>

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
    </div>
</section>