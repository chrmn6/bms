<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - Barangay Matina Gravahan Management System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .register-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
        }

        .welcome-section {
            flex: 1;
            padding: 40px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-section h1 {
            font-size: 4rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
            line-height: 1.1;
            text-align: left;
        }

        .welcome-section .subtitle {
            color: #6c757d;
            font-size: 1.3rem;
            margin-bottom: 0;
            font-weight: 400;
            text-align: left;
            max-width: 500px;
            line-height: 1.5;
        }

        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 60px 60px;
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 450px;
            margin: auto 0;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }

            .welcome-section {
                padding: 60px 40px 40px;
                text-align: center;
            }

            .welcome-section h1 {
                font-size: 2.5rem;
                margin-bottom: 20px;
            }

            .welcome-section .subtitle {
                font-size: 1.1rem;
                max-width: none;
                text-align: center;
            }

            .form-section {
                padding: 40px 20px 60px;
                max-height: none;
                overflow-y: visible;
            }

            .form-header h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .welcome-section h1 {
                font-size: 2rem;
            }

            .form-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center lg:justify-center min-h-screen flex-col">
    <div
        class="register-wrapper grid grid-cols-1 lg:grid-cols-2 gap-8 dark:bg-gray-800 overflow-hidden w-full max-w-6xl">

        <!-- Left Side - Welcome Text -->
        <div class="welcome-section p-12 lg:p-16 flex flex-col justify-center">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-6 text-center">JOIN BARANGAY MATINA GRAVAHAN
            </h1>
            <p class="subtitle text-gray-600 dark:text-gray-300 text-base text-center">
                Create your account to access the management system and help serve our community better.
            </p>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="form-section p-8 lg:p-12 flex justify-center items-center overflow-auto">
            <div class="form-container w-full max-w-md space-y-6">

                <!-- Form Header -->
                <div class="form-header text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Resident Registration</h2>
                    <p class="text-gray-600 dark:text-gray-300">Register to access barangay services</p>
                </div>

                <!-- Errors & Success -->
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <!-- First Name -->
                    <div class="col-span-1">
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                            :value="old('first_name')" required autofocus autocomplete="first_name" />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>

                    <!-- Last Name -->
                    <div class="col-span-1">
                        <x-input-label for="last_name" :value="__('Last Name')" />
                        <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                            :value="old('last_name')" required autocomplete="last_name" />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="col-span-1 md:col-span-2">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div class="col-span-1 md:col-span-2">
                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                            :value="old('phone_number')" required autocomplete="tel" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="col-span-1">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-span-1">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="col-span-1 md:col-span-2 flex items-center justify-end gap-4">
                        <a href="{{ route('login') }}"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button>
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>