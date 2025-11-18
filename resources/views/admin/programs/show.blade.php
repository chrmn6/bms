<div class="row align-items-center mb-3">
    <p class="col fw-bold text-base mb-0">APPLICATION ENTRY # {{ $a->display_id }}</p>
</div>
<div>
    <table class="w-full border border-black text-sm">
        <tbody>
            <tr class="border-b border-gray-500">
                <th class="text-left font-semibold p-2">FULL NAME</th>
                <td class="text-base">{{ $a->resident->full_name }}</td>
            </tr>
            <tr class="align-top border-b border-gray-500">
                <td colspan="2" class="p-2">
                    <div class="font-semibold mb-2">PROOF OF EVIDENCE</div>
                    @if($a->proof_file && file_exists(public_path('storage/uploads/applicants/' . $a->proof_file)))
                        <img src="{{ asset('storage/uploads/applicants/' . $a->proof_file) }}" alt="Proof of Evidence"
                            class="img-fluid mx-auto" style="max-width: 300px; display: block;">
                    @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </td>
            </tr>
            <tr class="align-top">
                <td colspan="2" class="p-2">
                    <div class="mb-3">
                        <label class="font-semibold mb-1">ADMIN NOTE</label>
                        <textarea id="admin-note" rows="2" class="w-full border rounded p-2"
                            placeholder="Leave a note...">{{ $a->note ?? '' }}</textarea>
                    </div>

                    @if($a->status === 'Pending')
                        <form id="approve-form" action="{{ route('admin.programs.approve', $a->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            <input type="hidden" name="note" id="approve-note">
                            <button type="submit" class="btn btn-success btn-sm"
                                onclick="document.getElementById('approve-note').value = document.getElementById('admin-note').value;
                                                                return confirm('Are you sure you want to approve this application?');">
                                Approve
                            </button>
                        </form>

                        <form id="reject-form" action="{{ route('admin.programs.reject', $a->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            <input type="hidden" name="note" id="reject-note">
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="document.getElementById('reject-note').value = document.getElementById('admin-note').value; 
                                                                return confirm('Are you sure you want to reject this application?');">
                                Reject
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>