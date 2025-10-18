<section>
    <div>
        <form method="POST" action="{{ route('residents.update')  }}" class="space-y-8" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4 flex flex-col items-center">
                <label for="image" class="relative cursor-pointer group">
                    <div
                        class="w-32 h-32 rounded-full overflow-hidden border-2 shadow-md flex items-center justify-center bg-gray-100">
                        @if ($resident->image)
                            <img id="profilePreview" src="{{ asset('uploads/residents/' . $resident->image) }}"
                                class="w-full h-full object-cover" alt="Profile Photo">
                            <span id="uploadText" class="hidden text-gray-500 text-sm">Upload Photo</span>
                        @else
                            <img id="profilePreview" class="hidden w-full h-full object-cover" alt="Profile Photo">
                            <span id="uploadText" class="text-gray-500 text-sm">Upload Photo</span>
                        @endif

                        <input type="file" name="image" id="image" class="hidden">
                    </div>
                </label>

                <!-- RESIDENT NAME-->
                <label class="text-gray-700 dark:text-gray-300 font-semibold mt-3 text-center text-xl">
                    {{ $resident->full_name }}
                </label>

                <!-- RESIDENT Email-->
                <label class="text-gray-700 dark:text-gray-300 font-normal text-center text-base">
                    {{ $user->email }}
                </label>
            </div>

            <header>
                <h2 class="text-xl bold font-medium text-gray-900 dark:text-gray-100">
                    Basic Information
                </h2>
            </header>

            <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!--First name-->
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                        :value="old('first_name', $user->first_name)" required placeholder="Provide your first name" />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>

                <!--Last name-->
                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                        :value="old('last_name', $user->last_name)" required placeholder="Provide your last name" />
                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                </div>

                <!--Middle name-->
                <div>
                    <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" />
                    <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full"
                        :value="old('middle_name', $resident->middle_name ?? '') "
                        placeholder="Provide your middle name" />
                    <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                </div>

                <!--Suffix-->
                <div>
                    <x-input-label for="suffix" :value="__('Suffix')" />
                    <select id="suffix" name="suffix" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">N/A</option>
                        <option value="Jr." {{ old('suffix', $resident->suffix ?? '') == 'Jr.' ? 'selected' : '' }}>Jr.
                        </option>
                        <option value="Sr." {{ old('suffix', $resident->suffix ?? '') == 'Sr.' ? 'selected' : '' }}>Sr.
                        </option>
                        <option value="III" {{ old('suffix', $resident->suffix ?? '') == 'III' ? 'selected' : '' }}>III
                        </option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
                </div>

                <!--Place of birth-->
                <div>
                    <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                    <x-text-input id="place_of_birth" name="place_of_birth" type="text" class="mt-1 block w-full"
                        :value="old('place_of_birth', $resident->place_of_birth ?? '')"
                        placeholder="Provide your place of birth" />
                    <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                </div>

                <!--Date of birth-->
                <div>
                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                    <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full"
                        :value="old('date_of_birth', $resident->date_of_birth ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                </div>

                <!--Gender-->
                <div>
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $resident->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="Female" {{ old('gender', $resident->gender ?? '') == 'Female' ? 'selected' : '' }}>
                            Female</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                </div>

                <!--Household-->
                <div>
                    <x-input-label for="household_id" :value="__('Household')" />
                    <select id="household_id" name="household_id" class="mt-1 block w-full border-gray-300 rounded-md">
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
                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                        :value="old('address', $resident->address ?? '')" placeholder="Provide your address" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
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
            </div>

            <!--Additional Information-->
            <div class="mt-8">
                <h3 class="text-xl bold font-medium text-gray-900 dark:text-gray-100 mb-4">
                    Additional Information
                </h3>
                <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!--Civil Status-->
                    <div>
                        <x-input-label for="civil_status" :value="__('Civil Status')" />
                        <select id="civil_status" name="civil_status"
                            class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Select Civil Status</option>
                            <option value="Single" {{ old('civil_status', $profile->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="In A Relationship" {{ old('civil_status', $profile->civil_status ?? '') == 'In A Relationship' ? 'selected' : '' }}>In A Relationship</option>
                            <option value="Married" {{ old('civil_status', $profile->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ old('civil_status', $profile->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                            <option value="Divorced" {{ old('civil_status', $profile->civil_status ?? '') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
                    </div>

                    <!--Citizenship-->
                    <div>
                        <x-input-label for="citizenship" :value="__('Citizenship')" />
                        <x-text-input id="citizenship" name="citizenship" type="text" class="mt-1 block w-full"
                            :value="old('citizenship', $profile->citizenship ?? '')"
                            placeholder="Provide your citizenship" />
                        <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                    </div>

                    <!--Occupation-->
                    <div>
                        <x-input-label for="occupation" :value="__('Occupation')" />
                        <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full"
                            :value="old('occupation', $profile->occupation ?? '')"
                            placeholder="Provide your occupation" />
                        <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
                    </div>

                    <!--Education-->
                    <div>
                        <x-input-label for="education" :value="__('Education')" />
                        <select id="education" name="education" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Select Education Level</option>
                            <option value="Elementary" {{ old('education', $profile->education ?? '') == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                            <option value="High School" {{ old('education', $profile->education ?? '') == 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Vocational/Technical" {{ old('education', $profile->education ?? '') == 'Vocational/Technical' ? 'selected' : '' }}>Vocational/Technical</option>
                            <option value="College" {{ old('education', $profile->education ?? '') == 'College' ? 'selected' : '' }}>College</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('education')" />
                    </div>
                </div>
            </div>

            <!--Submit-->
            <div class="flex items-center">
                <x-primary-button>Save Changes</x-primary-button>
            </div>

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
</section>