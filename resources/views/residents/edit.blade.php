<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resident Profile') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Resident Profile Info --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('residents.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        {{-- Middle Name --}}
                        <div>
                            <x-input-label for="middle_name" :value="__('Middle Name')" />
                            <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full"
                                :value="old('middle_name', $resident->middle_name ?? '')" />
                            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                        </div>

                        {{-- Suffix --}}
                        <div>
                            <x-input-label for="suffix" :value="__('Suffix')" />
                            <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full"
                                :value="old('suffix', $resident->suffix ?? '')" />
                            <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
                        </div>

                        {{-- Place of Birth --}}
                        <div>
                            <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                            <x-text-input id="place_of_birth" name="place_of_birth" type="text"
                                class="mt-1 block w-full" :value="old('place_of_birth', $resident->place_of_birth ?? '')" />
                            <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                        </div>

                        {{-- Date of Birth --}}
                        <div>
                            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full"
                                :value="old('date_of_birth', $resident->date_of_birth ?? '')" />
                            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                        </div>

                        {{-- Gender --}}
                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $resident->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $resident->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>

                        {{-- Address --}}
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $resident->address ?? '')" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Save Changes') }}
                            </x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Saved.') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>