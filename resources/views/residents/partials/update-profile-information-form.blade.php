<section>
    {{-- Resident Profile Info --}}
    <div class="bg-white dark:bg-gray-800">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Personal Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Before you proceed, kindly fill out the necessary fields. If not applicable, just type") }}
                <b>N/A</b>.
            </p>
        </header>
        <div class="max-w-xl">
            <form method="POST" action="{{ route('residents.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                        :value="old('first_name', $user->first_name)" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                        :value="old('last_name', $user->last_name)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                </div>

                {{-- Middle Name --}}
                <div class="mt-2">
                    <x-input-label for="middle_name" :value="__('Middle Name')" />
                    <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full"
                        :value="old('middle_name', $resident->middle_name ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                </div>

                {{-- Suffix --}}
                <div class="mt-2">
                    <x-input-label for="suffix" :value="__('Suffix')" />
                    <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full" :value="old('suffix', $resident->suffix ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
                </div>

                {{-- Place of Birth --}}
                <div class="mt-2">
                    <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                    <x-text-input id="place_of_birth" name="place_of_birth" type="text" class="mt-1 block w-full"
                        :value="old('place_of_birth', $resident->place_of_birth ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                </div>

                {{-- Date of Birth --}}
                <div class="mt-2">
                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                    <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full"
                        :value="old('date_of_birth', $resident->date_of_birth ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                </div>

                {{-- Gender --}}
                <div class="mt-2">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $resident->gender ?? '') == 'Male' ? 'selected' : '' }}>
                            Male</option>
                        <option value="Female" {{ old('gender', $resident->gender ?? '') == 'Female' ? 'selected' : '' }}>
                            Female</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                </div>

                {{-- Address --}}
                <div class="mt-2">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                        :value="old('address', $resident->address ?? '')" />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <div class="mt-2">
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

                {{-- Resident Profile Fields --}}
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Additional Profile Info
                    </h3>

                    {{-- Civil Status --}}
                    <div class="mt-2">
                        <x-input-label for="civil_status" :value="__('Civil Status')" />
                        <select id="civil_status" name="civil_status"
                            class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Select Civil Status</option>
                            <option value="Single" {{ old('civil_status', $profile->civil_status ?? '') == 'Single' ? 'selected' : '' }}>
                                Single</option>
                            <option value="Married" {{ old('civil_status', $profile->civil_status ?? '') == 'Married' ? 'selected' : '' }}>
                                Married</option>
                            <option value="Widowed" {{ old('civil_status', $profile->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>
                                Widowed</option>
                            <option value="Divorced" {{ old('civil_status', $profile->civil_status ?? '') == 'Divorced' ? 'selected' : '' }}>
                                Divorced</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
                    </div>

                    {{-- Citizenship --}}
                    <div class="mt-2">
                        <x-input-label for="citizenship" :value="__('Citizenship')" />
                        <x-text-input id="citizenship" name="citizenship" type="text" class="mt-1 block w-full"
                            :value="old('citizenship', $profile->citizenship ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                    </div>

                    {{-- Occupation --}}
                    <div class="mt-2">
                        <x-input-label for="occupation" :value="__('Occupation')" />
                        <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full"
                            :value="old('occupation', $profile->occupation ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
                    </div>

                    {{-- Education --}}
                    <div class="mt-2">
                        <x-input-label for="education" :value="__('Education')" />
                        <select id="education" name="education" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Select Education Level</option>
                            <option value="Elementary" {{ old('education', $profile->education ?? '') == 'Elementary' ? 'selected' : '' }}>
                                Elementary</option>
                            <option value="High School" {{ old('education', $profile->education ?? '') == 'High School' ? 'selected' : '' }}>
                                High School</option>
                            <option value="Vocational/Technical" {{ old('education', $profile->education ?? '') == 'Vocational/Technical' ? 'selected' : '' }}>Vocational/Technical
                            </option>
                            <option value="College" {{ old('education', $profile->education ?? '') == 'College' ? 'selected' : '' }}>College
                            </option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('education')" />
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex items-center gap-4">
                    <x-primary-button>
                        {{ __('Save Changes') }}
                    </x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
                            x-transition
                            style="background-color: #16a34a; color: #fff; z-index: 9999; left: 50%; transform: translateX(-50%);"
                            class="fixed top-10 px-6 py-3 rounded shadow-lg min-w-[200px]">
                            {{ __('Saved.') }}
                            <button @click="show = false" style="color: #fff;" class="ml-2 font-bold float-right">×</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>