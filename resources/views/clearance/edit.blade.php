@section('title') {{ 'Edit Clearance' }} @endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Clearance Status') }}
        </h2>
    </x-slot>

    @if ($errors->any())
        <div class="mb-3 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('clearances.update', $clearance->clearance_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2">
                                <option value="pending" {{ old('status', $clearance->status) === 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="released" {{ old('status', $clearance->status) === 'released' ? 'selected' : '' }}>
                                    Released</option>
                                <option value="approved" {{ old('status', $clearance->status) === 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ old('status', $clearance->status) === 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>

                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="remarks"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-300">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" required
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md p-2"
                                placeholder="Enter any notes here.">{{ old('remarks', $clearance->remarks) }}</textarea>

                            @error('remarks')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-primary-button type="submit" class="!bg-green-500 hover:!bg-green-600 active:!bg-green-700">
                            Update
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>