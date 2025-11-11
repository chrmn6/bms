<form hx-put="{{ route('admin.staff.update', $staff->id) }}" hx-target="#editStaffModalBody" hx-swap="none"
    hx-on::after-request="
        if (event.detail.xhr.status === 200) { 
            const modal = bootstrap.Modal.getInstance(document.getElementById('editStaffModal')); 
            if (modal) { modal.hide(); } 
            htmx.trigger(document.body, 'refreshTable');
        }
    ">
    @csrf
    @method('PUT')

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text"
                value="{{ old('first_name', $staff->first_name) }}"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" readonly />
        </div>
        <div class="col-md-6">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" value="{{ old('last_name', $staff->last_name) }}"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" readonly />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" value="{{ old('email', $staff->email) }}"
                class="mt-1 block w-full bg-gray-100 cursor-not-allowed" readonly />
        </div>
        <div class="col-md-6">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text"
                value="{{ old('phone_number', $staff->phone_number) }}" class="mt-1 block w-full" />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role"
                class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed"
                disabled>
                <option value="admin" {{ old('role', $staff->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ old('role', $staff->role) === 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
            <input type="hidden" name="role" value="{{ $staff->role }}">
        </div>


        <div class="col-md-6">
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status"
                class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#6D0512] focus:border-[#6D0512]">
                <option value="Active" {{ old('status', $staff->status) === 'Active' ? 'selected' : '' }}>Active
                </option>
                <option value="Inactive" {{ old('status', $staff->status) === 'Inactive' ? 'selected' : '' }}>Inactive
                </option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Update
        </x-primary-button>
    </div>
</form>