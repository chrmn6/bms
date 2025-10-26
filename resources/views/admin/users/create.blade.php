<form hx-post="{{ route('admin.staff.store') }}" hx-target="#userModalBody" hx-swap="none" hx-on::after-request="
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
    </div>

    <div class="mt-3 d-flex justify-content-end gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Create Staff</button>
    </div>
</form>