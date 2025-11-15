{{-- <x-resident-layout>
    <h2>{{ $program->title }}</h2>
    <p>{{ $program->description }}</p>
    <p>Applicants: {{ $program->applications->count() }}/{{ $program->applicants_limit }}</p>
    <p>Application period: {{ $program->application_start->format('Y-m-d') }} to
        {{ $program->application_end->format('Y-m-d') }}
    </p>

    @php
    $user = auth()->user();
    $hasApplied = $program->applications->where('resident_id', $user->resident->resident_id ?? null)->isNotEmpty();
    @endphp

    @if($hasApplied)
    <button disabled>Already Applied</button>
    @else
    <form action="{{ route('programs.join', $program) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="proof_file" required>
        <input type="text" name="note" placeholder="Optional note">
        <button type="submit">Apply</button>
    </form>
    @endif
</x-resident-layout> --}}