<form hx-post="{{ route('clearances.store') }}" hx-swap="none" hx-on::after-request="
    if (event.detail.xhr.status === 200) {
        const modal = bootstrap.Modal.getInstance(document.getElementById('addClearanceModal'));
        modal.hide();
        htmx.trigger(document.body, 'refreshTable');
    }">
    @csrf
    <div class="mb-2">
        <x-input-label for="clearance_type" :value="__('Clearance Type')" />
        <select id="clearance_type" name="clearance_type" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
            <option value="">Select type</option>
            <option value="Barangay Clearance">Barangay Clearance</option>
            <option value="Business Clearance">Business Clearance</option>
            <option value="Residency Clearance">Residency Clearance</option>
            <option value="Barangay Indigency">Barangay Indigency</option>
        </select>
    </div>

    <div class="mb-2">
        <x-input-label for="purpose" :value="__('Purpose')" />
        <textarea id="purpose" name="purpose" rows="2" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            placeholder="Explain why you need this clearance"></textarea>
    </div>

    <div class="mb-2">
        <span class="inline-block bg-blue-50 font-semibold text-blue-500 text-sm px-3 py-1">
            Note: There is a fee of ₱20 for requesting any type of clearance.
        </span>
    </div>

    <div class="mb-2">
        <x-input-label for="payment_method" :value="__('Payment Method')" />

        <select id="payment_method" name="payment_method" required
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            onchange="toggleGCashField()">
            <option value="">Select payment method</option>
            <option value="Cash">Cash</option>
            <option value="GCash">GCash</option>
        </select>
    </div>

    <div id="gcash_section" class="mb-2" style="display: none;">
        <x-input-label value="GCash Account" />
        <img src="{{ asset('storage/images/gcash-sample.jpg') }}" alt="GCash Sample" class="w-64 mb-3 rounded border">

        <x-input-label for="gcash_reference" :value="__('Reference Number')" />
        <input type="text" id="gcash_reference" name="gcash_reference"
            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
            placeholder="Enter GCash reference number">
    </div>

    <div class="d-flex justify-content-end gap-2">
        <x-primary-button type="submit" class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D]">
            Submit
        </x-primary-button>
    </div>
</form>

<script>
    function toggleGCashField() {
        const method = document.getElementById("payment_method").value;
        const gcashSection = document.getElementById("gcash_section");

        if (method === "GCash") {
            gcashSection.style.display = "block";
            document.getElementById("gcash_reference").required = true;
        } else {
            gcashSection.style.display = "none";
            document.getElementById("gcash_reference").required = false;
        }
    }
</script>