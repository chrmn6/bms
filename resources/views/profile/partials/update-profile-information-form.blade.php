@section('title') {{ 'Profile' }} @endsection


<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!--PROFILE HEADER-->
    <div class="py-3 mt-2 border border-gray-300 bg-neutral-50 shadow-sm dark:bg-gray-900 dark:border-gray-700">
        <div class="card-body !px-2.5 flex flex-col items-center text-center">
            <!-- Profile Picture -->
            <label for="image" class="relative cursor-pointer group d-block text-center">
                @if ($user->image)
                    <img id="profilePreview" src="{{ asset('storage/uploads/users/' . $user->image) }}"
                        class="rounded-circle" alt="Profile Photo"
                        style="width: 110px; height: 110px; object-fit: cover; border: 2px solid #6D0512; margin-bottom: 4px;">
                @else
                    <img id="profilePreview" src="{{ asset('storage/images/default-avatar.jpg') }}" class="rounded-circle"
                        alt="Default Profile Photo"
                        style="width: 110px; height: 110px; object-fit: cover; border: 2px solid #6D0512; margin-bottom: 4px;">
                @endif
                <input type="file" name="image" id="image" class="d-none">
            </label>

            <!-- Name + Display ID -->
            <div class="flex items-baseline justify-center gap-1" style="margin-bottom: 2px;">
                <h5 class="text-lg font-semibold m-0">{{ $user->full_name }}</h5>
                <p class="text-sm text-blue-600 dark:text-blue-400 m-0">
                    #{{ $user->display_id }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 m-0">
                    {{ ucfirst($user->role) }}
                </p>
            </div>

            <!-- Joined Date -->
            <p class="text-sm text-slate-500 dark:text-zinc-300 m-0">
                Joined on {{ $user->created_at->format('F d, Y') }}
            </p>
        </div>

        <!--PERSONAL & ADDRESS INFO-->
        <div class="py-3 mt-2 mb-2 bg-neutral-50 dark:bg-gray-900">
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
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <table class="table-auto border-collapse text-sm w-full m-0 p-0">
                            <tbody>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--SUBMIT BUTTON-->
        <div class="flex justify-end p-3">
            <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
                Save Changes
            </x-primary-button>
        </div>
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