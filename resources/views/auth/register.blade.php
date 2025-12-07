<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('storage/images/bms-logo.png')}}">

    <title>Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex justify-center min-h-screen">
    <div class="form-section p-6 flex justify-center items-center overflow-auto w-full">
        <div class="form-container w-full max-w-7xl space-y-4 bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
            <div class="form-header text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Resident Registration</h1>
                <p class="text-gray-600 dark:text-gray-300">Create your account to access the barangay management
                    system.</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM START -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- INFO SECTION -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                        <!-- FIRST NAME -->
                        <div>
                            <x-input-label for="first_name" value="First Name *" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                value="{{ old('first_name') }}" placeholder="John" required />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- MIDDLE NAME -->
                        <div>
                            <x-input-label for="middle_name" value="Middle Name *" />
                            <x-text-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name"
                                value="{{ old('middle_name') }}" placeholder="Smith" />
                            <x-input-error :messages="$errors->get('middle_name')" class="mt-2" />
                        </div>

                        <!-- LAST NAME -->
                        <div>
                            <x-input-label for="last_name" value="Last Name *" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                value="{{ old('last_name') }}" placeholder="Doe" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- SUFFIX -->
                        <div>
                            <x-input-label for="suffix" value="Suffix *" />
                            <select id="suffix" name="suffix"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">N/A</option>
                                <option value="Jr." {{ old('suffix') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                <option value="Sr." {{ old('suffix') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                <option value="III" {{ old('suffix') == 'III' ? 'selected' : '' }}>III</option>
                            </select>
                            <x-input-error :messages="$errors->get('suffix')" class="mt-2" />
                        </div>

                        <!-- GENDER -->
                        <div>
                            <x-input-label for="gender" value="Gender *" />
                            <select name="gender" id="gender"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Select gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- CIVIL STATUS -->
                        <div>
                            <x-input-label for="civil_status" value="Civil Status *" />
                            <select name="civil_status" id="civil_status"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Select civil status</option>
                                <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single
                                </option>
                                <option value="In A Relationship" {{ old('civil_status') == 'In A Relationship' ? 'selected' : '' }}>In A
                                    Relationship</option>
                                <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married
                                </option>
                                <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed
                                </option>
                                <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>
                                    Divorced</option>
                            </select>
                            <x-input-error :messages="$errors->get('civil_status')" class="mt-2" />
                        </div>

                        <!-- DATE OF BIRTH -->
                        <div>
                            <x-input-label for="date_of_birth" value="Date of Birth *" />
                            <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                                value="{{ old('date_of_birth') }}" required />
                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                        </div>

                        <!-- PLACE OF BIRTH -->
                        <div>
                            <x-input-label for="place_of_birth" value="Place of Birth *" />
                            <x-text-input id="place_of_birth" class="block mt-1 w-full" type="text"
                                name="place_of_birth" value="{{ old('place_of_birth') }}"
                                placeholder="Enter place of birth" required />
                            <x-input-error :messages="$errors->get('place_of_birth')" class="mt-2" />
                        </div>

                        <!-- PHONE NUMBER -->
                        <div>
                            <x-input-label for="phone_number" value="Contact Number *" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                value="{{ old('phone_number') }}" placeholder="Enter contact number" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>

                        <!-- EDUCATION -->
                        <div>
                            <x-input-label for="education" value="Education *" />
                            <select id="education" name="education"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Select education</option>
                                <option value="Elementary" {{ old('education') == 'Elementary' ? 'selected' : '' }}>
                                    Elementary</option>
                                <option value="High School" {{ old('education') == 'High School' ? 'selected' : '' }}>High
                                    School</option>
                                <option value="Vocational/Technical" {{ old('education') == 'Vocational/Technical' ? 'selected' : '' }}>
                                    Vocational/Technical</option>
                                <option value="College" {{ old('education') == 'College' ? 'selected' : '' }}>College
                                </option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('education')" />
                        </div>

                        <!-- OCCUPATION -->
                        <div>
                            <x-input-label for="occupation" value="Occupation *" />
                            <select id="occupation" name="occupation"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Select employment</option>
                                <option value="Self-Employed" {{ old('occupation') == 'Self-Employed' ? 'selected' : '' }}>
                                    Self-Employed</option>
                                <option value="Unemployed" {{ old('occupation') == 'Unemployed' ? 'selected' : '' }}>
                                    Unemployed</option>
                                <option value="Employed" {{ old('occupation') == 'Employed' ? 'selected' : '' }}>Employed
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                        </div>

                        <!-- CITIZENSHIP -->
                        <div>
                            <x-input-label for="citizenship" value="Citizenship *" />
                            <x-text-input id="citizenship" class="block mt-1 w-full" type="text" name="citizenship"
                                value="{{ old('citizenship') }}" placeholder="Enter your citizenship" />
                            <x-input-error :messages="$errors->get('citizenship')" class="mt-2" />
                        </div>

                        <!-- BLOOD TYPE -->
                        <div>
                            <x-input-label for="blood_type" value="Blood Type *" />
                            <x-text-input id="blood_type" name="blood_type" type="text" class="block mt-1 w-full"
                                value="{{ old('blood_type') }}" placeholder="e.g. A+, O-, B+" />
                            <x-input-error class="mt-2" :messages="$errors->get('blood_type')" />
                        </div>

                        <!-- VOTER STATUS -->
                        <div>
                            <x-input-label for="voter_status" value="Registered Voter? *" />
                            <select name="voter_status" id="voter_status"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Select</option>
                                <option value="Yes" {{ old('voter_status') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('voter_status') == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('voter_status')" />
                        </div>
                    </div>
                </div>

                <!-- ADDRESS SECTION -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Address Information
                    </h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">

                        <!-- PHASE -->
                        <div>
                            <x-input-label for="phase_id" value="Phase *" />
                            <select id="phase_id" name="phase_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Choose phase</option>
                                @foreach($phases as $phase)
                                    <option value="{{ $phase->phase_id }}" {{ old('phase_id') == $phase->phase_id ? 'selected' : '' }}>
                                        {{ $phase->phase_number }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('phase_id')" />
                        </div>

                        <!-- HOUSEHOLD -->
                        <div>
                            <x-input-label for="household_id" value="Household *" />
                            <select id="household_id" name="household_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Choose household</option>
                                @foreach($households as $household)
                                    <option value="{{ $household->household_id }}" {{ old('household_id') == $household->household_id ? 'selected' : '' }}>
                                        {{ $household->household_number }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('household_id')" />
                        </div>

                        <!--Address-->
                        <div>
                            <x-input-label for="address" value="Street Address *" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                value="{{ old('address') }}" placeholder="Enter your address" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- CREATE SECTION -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Create Account
                    </h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                        <!-- EMAIL -->
                        <div>
                            <x-input-label for="email" value="Email *" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                value="{{ old('email') }}" placeholder="Enter email address" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <x-input-label for="password" value="Password *" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                placeholder="Create password" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div>
                            <x-input-label for="password_confirmation" value="Confirm Password *" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" placeholder="Re-enter password" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('login') }}"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Already registered?
                    </a>

                    <x-primary-button class="ms-3">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>