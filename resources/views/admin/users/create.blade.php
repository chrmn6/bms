<form hx-post="{{ route('admin.staff.store') }}" enctype="multipart/form-data" hx-target="#userModalBody" hx-swap="none"
    hx-on::after-request="
        if (event.detail.xhr.status === 200) { 
            const modal = bootstrap.Modal.getInstance(document.getElementById('userModal')); 
            if (modal) { modal.hide(); } 
            htmx.trigger(document.body, 'refreshTable');
        }
    ">
    @csrf

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" required />
        </div>
        <div class="col-md-6">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" required />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
        </div>
        <div class="col-md-6">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
        </div>
        <div class="col-md-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" required />
        </div>

        <div class="mb-3">
            <label class="block text-gray-700 dark:text-gray-300">Upload image</label>
            <input type="file" name="image" id="image"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Create
        </x-primary-button>
    </div>
</form>