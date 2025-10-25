@section('title') {{ 'Profile' }} @endsection

<section>
    <link rel="stylesheet" href="{{ asset('css/dashboard-styles.css') }}">
    <script src="{{ asset('js/dashboard-scripts.js') }}"></script>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-person-gear"></i>
                    Profile Information
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update')  }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row g-1 mb-2">
                        <div class="col-md-4 mb-2">
                            <x-input-label for="first_name" :value="__('First Name')" />
                            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                                :value="old('first_name', $user->first_name)" required
                                placeholder="Provide your first name" />
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                        </div>

                        <div class="col-md-4 mb-2">
                            <x-input-label for="last_name" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                                :value="old('last_name', $user->last_name)" required
                                placeholder="Provide your last name" />
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                        </div>

                        <div class="col-md-4 mb-2">
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
                    </div>

                    <div class="row g-1 mb-2">

                        <div class="col-md-4 mb-3">
                            <x-input-label for="phone_number" :value="__('Phone Number')" />
                            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                                :value="old('phone_number', $user->phone_number)" required
                                placeholder="Provide your number" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>

                        <div class="col-md-4 mb-3">
                            <x-input-label for="role" :value="__('Role')" />
                            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full"
                                :value="ucfirst(auth()->user()->role)" readonly />
                            <div class="form-text">Role cannot be changed. </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <x-input-label for="created_at" :value="__('Member since')" />
                            <x-text-input id="created_at" name="created_at" type="text" class="mt-1 block w-full"
                                :value="auth()->user()->created_at->format('F d, Y')" readonly />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>Save Changes</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>