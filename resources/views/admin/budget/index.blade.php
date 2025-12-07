@section('title') {{ 'Manage Financial' }} @endsection

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-3">
            <h5 class="text-base font-semibold mb-3 text-gray-500 dark:text-gray-100">Financial</h5>
            <div class="items-center justify-between gap-4 pb-4 bg-neutral-50 dark:bg-gray-900 shadow-md sm:rounded-lg">
                <!--BUDGET BUTTON-->
                <div class="flex justify-end gap-2 w-full p-3">
                    <x-primary-button type="button" hx-get="{{ route('admin.budget.transactions') }}"
                        hx-target="#transactionsModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#transactionsModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D flex items-center gap-1">
                        Financial Transactions
                    </x-primary-button>

                    <x-primary-button type="button" hx-get="{{ route('admin.budget.create') }}"
                        hx-target="#budgetModalBody" hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal"
                        data-bs-target="#budgetModal"
                        class="!bg-[#6D0512] hover:!bg-[#8A0A1A] active:!bg-[#50040D] flex items-center gap-1">
                        Add Budget
                    </x-primary-button>
                </div>

                <!--BUDGET TABLE-->
                <div class="overflow-y-auto h-80 border">
                    @include('admin.budget.table', ['budgets' => $budgets])
                </div>

                <!-- TOTAL BUDGET DISPLAY -->
                <div class="px-3 py-2 bg-slate-100 dark:bg-gray-800 border-t">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Total Budget:</span>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">
                            ₱{{ number_format($budgets->sum('amount'), 2) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Add Budget Modal -->
            <div class="modal fade" id="budgetModal" tabindex="-1" aria-labelledby="budgetModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white py-2">
                            <h5 class="modal-title" id="budgetModalLabel">
                                Add Budget
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="budgetModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Transactions Modal -->
            <div class="modal fade" id="transactionsModal" tabindex="-1" aria-labelledby="transactionsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header !bg-[#6D0512] text-white py-2">
                            <h5 class="modal-title" id="transactionsModalLabel">
                                Financial Transaction Log
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="transactionsModalBody">
                            <div class="text-center py-5 text-muted">
                                <div class="spinner-border text-primary mb-3" role="status"></div>
                                <p>Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert Messages -->
    <script>
        document.body.addEventListener('budgetCreated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "Budget added successfully.",
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('budgetUpdated', function (event) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "Budget updated successfully.",
                showConfirmButton: false,
                timer: 2000,
                width: '400px',
            });
        });

        document.body.addEventListener('closeModal', function () {
            const modalEl = document.querySelector('.modal.show');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
            }
        });
    </script>
</x-app-layout>