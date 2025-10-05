<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Blotter Status') }}
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
                    <form action="{{ route('blotters.update', $blotter->blotter_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="w-full border rounded p-2">
                                <option value="pending" {{ old('status', $blotter->status) === 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="processing" {{ old('status', $blotter->status) === 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="approved" {{ old('status', $blotter->status) === 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="rejected" {{ old('status', $blotter->status) === 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>