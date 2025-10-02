<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Your Profile</h1>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/residents/profile') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Middle Name</label>
                <input type="text" name="middle_name" value="{{ old('middle_name', $resident->middle_name ?? '') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Suffix</label>
                <input type="text" name="suffix" value="{{ old('suffix', $resident->suffix ?? '') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Place of Birth</label>
                <input type="text" name="place_of_birth"
                    value="{{ old('place_of_birth', $resident->place_of_birth ?? '') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth"
                    value="{{ old('date_of_birth', $resident->date_of_birth ?? '') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Gender</label>
                <select name="gender"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $resident->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="Female" {{ old('gender', $resident->gender ?? '') == 'Female' ? 'selected' : '' }}>
                        Female
                    </option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', $resident->address ?? '') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>