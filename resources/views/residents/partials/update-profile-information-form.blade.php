@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/users-styles.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>
    <script src="{{ asset('js/users-scripts.js') }}"></script>
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
            <div class="card-body">
                <form method="POST" action="{{ route('residents.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mx-auto row">
                        <!-- Profile Picture -->
                        <div class="col-md-3">
                            <label for="image" class="relative cursor-pointer group d-block text-center">
                                @if ($resident->profile?->image)
                                    <img id="profilePreview"
                                        src="{{ asset('uploads/residents/' . $resident->profile->image) }}"
                                        class="rounded-circle mb-2" alt="Profile Photo"
                                        style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #6D0512;">
                                    <span id="uploadText" class="hidden text-gray-500 text-sm">Upload Photo</span>
                                @else
                                    <img id="profilePreview" src="{{ asset('images/default-avatar.png') }}"
                                        class="rounded-circle mb-2" alt="Default Profile Photo"
                                        style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #6D0512;">
                                    <span id="uploadText" class="text-gray-500 text-sm">Upload Photo</span>
                                @endif

                                <input type="file" name="image" id="image" class="d-none">
                            </label>
                        </div>

                        <!-- Basic Information -->
                        <div class="col-md-9">
                            <h4 class="mt-2 mb-3 font-bold">Basic Information</h4>

                            <div class="row g-3">
                                <!--FIRST NAME-->
                                <div class="col-md-4">
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <x-text-input id="first_name" name="first_name" type="text"
                                        class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required
                                        placeholder="Provide your first name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                </div>

                                <!--LAST NAME-->
                                <div class="col-md-4">
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                        :value="old('last_name', $user->last_name)" required
                                        placeholder="Provide your last name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                </div>

                                <!--MIDDLE NAME-->
                                <div class="col-md-4">
                                    <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" />
                                    <x-text-input id="middle_name" name="middle_name" type="text"
                                        class="mt-1 block w-full" :value="old('middle_name', $resident->middle_name ?? '') " placeholder="Provide your middle name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                                </div>

                                <!--SUFFIX-->
                                <div class="col-md-4">
                                    <x-input-label for="suffix" :value="__('Suffix')" />
                                    <select id="suffix" name="suffix"
                                        class="mt-1 block w-full border-gray-300 rounded-md">
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
                                </div>

                                <!--GENDER-->
                                <div class="col-md-4">
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender"
                                        class="mt-1 block w-full border-gray-300 rounded-md">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender', $resident->profile->gender ?? '') == 'Male' ? 'selected' : ''}}>Male</option>
                                        <option value="Female" {{ old('gender', $resident->profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                                </div>

                                <!--DATE OF BIRTH-->
                                <div class="col-md-4">
                                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                    <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                                        class="mt-1 block w-full" :value="old('date_of_birth', $resident->profile->date_of_birth ? $resident->profile->date_of_birth->format('Y-m-d') : '')" />
                                    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                                </div>

                                <!--PLACE OF BIRTH-->
                                <div class="col-md-4">
                                    <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                                    <x-text-input id="place_of_birth" name="place_of_birth" type="text"
                                        class="mt-1 block w-full" :value="old('place_of_birth', $resident->profile->place_of_birth ?? '')"
                                        placeholder="Provide your place of birth" />
                                    <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                                </div>

                                <!--Household-->
                                <div class="col-md-4">
                                    <x-input-label for="household_id" :value="__('Household')" />
                                    <select id="household_id" name="household_id"
                                        class="mt-1 block w-full border-gray-300 rounded-md">
                                        <option value="">Select Household</option>
                                        @foreach($households as $household)
                                            <option value="{{ $household->household_id }}" {{ $resident->household_id == $household->household_id ? 'selected' : '' }}>
                                                {{ $household->household_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('household_id')" />
                                </div>

                                <!--Address-->
                                <div class="col-md-4">
                                    <x-input-label for="address" :value="__('Address')" />
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                        :value="old('address', $resident->address ?? '')"
                                        placeholder="Provide your address" />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>

                                <h4 class="mt-3 font-bold">Additional Information</h4>

                                <!--EMAIL-->
                                <div class="col-md-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                        :value="old('email', $user->email)" required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                {{ __('Your email address is unverified.') }}

                                                <button form="send-verification"
                                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                    {{ __('Click here to re-send the verification email.') }}
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                    {{ __('A new verification link has been sent to your email address.') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <!--Civil Status-->
                                <div class="col-md-4">
                                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                                    <select id="civil_status" name="civil_status"
                                        class="mt-1 block w-full border-gray-300 rounded-md">
                                        <option value="">Select Civil Status</option>
                                        <option value="Single" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="In A Relationship" {{ old('civil_status', $resident->details->civil_status ?? '') == 'In A Relationship' ? 'selected' : '' }}>In A Relationship</option>
                                        <option value="Married" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Widowed" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                        <option value="Divorced" {{ old('civil_status', $resident->details->civil_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
                                </div>

                                <!--Citizenship-->
                                <div class="col-md-4">
                                    <x-input-label for="citizenship" :value="__('Citizenship')" />
                                    <x-text-input id="citizenship" name="citizenship" type="text"
                                        class="mt-1 block w-full" :value="old('citizenship', $resident->details->citizenship ?? '')"
                                        placeholder="Provide your citizenship" />
                                    <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                                </div>

                                <!--Education-->
                                <div class="col-md-4">
                                    <x-input-label for="education" :value="__('Education')" />
                                    <select id="education" name="education"
                                        class="mt-1 block w-full border-gray-300 rounded-md">
                                        <option value="">Select Education Level</option>
                                        <option value="Elementary" {{ old('education', $resident->details->education ?? '') == 'Elementary' ? 'selected' : '' }}>
                                            Elementary</option>
                                        <option value="High School" {{ old('education', $resident->details->education ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                                        <option value="Vocational/Technical" {{ old('education', $resident->details->education ?? '') == 'Vocational/Technical' ? 'selected' : '' }}>Vocational/Technical
                                        </option>
                                        <option value="College" {{ old('education', $resident->details->education ?? '') == 'College' ? 'selected' : '' }}>College</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('education')" />
                                </div>

                                <!--Occupation-->
                                <div class="col-md-4">
                                    <x-input-label for="occupation" :value="__('Occupation')" />
                                    <x-text-input id="occupation" name="occupation" type="text"
                                        class="mt-1 block w-full" :value="old('occupation', $resident->details->occupation ?? '')" placeholder="Provide your occupation" />
                                    <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
                                </div>

                                <!--SUBMIT BUTTON-->
                                <div class="flex justify-end">
                                    <x-primary-button>Save Changes</x-primary-button>
                                </div>
                            </div>
                        </div>
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
                </form>
            </div>
        </div>
    </div>
</section>