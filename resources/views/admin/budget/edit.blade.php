<form hx-put="{{ route('admin.budget.update', $budget->budget_id) }}" hx-target="#financialTableContainer"
    hx-swap="innerHTML" hx-on::after-request="
        if (event.detail.xhr.status === 200) { 
            const modal = bootstrap.Modal.getInstance(document.getElementById('editBudgetModal')); 
            if (modal) { modal.hide(); } 
            htmx.trigger(document.body, 'refreshTable');
        }
    ">
    @csrf
    @method('PUT')

    <div class="row g-3 mb-2">
        <div class="col-md-12">
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="amount" name="amount" type="number" step="0.01"
                value="{{ old('amount', $budget->amount) }}" class="mt-1 block w-full" required />
        </div>
    </div>

    <div class="row g-3 mb-2">
        <div class="col-md-12">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text"
                value="{{ old('description', $budget->description) }}" class="mt-1 block w-full" />
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Update
        </x-primary-button>
    </div>
</form>