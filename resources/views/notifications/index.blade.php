@section('title') {{ 'Notifications' }} @endsection

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="py-3">
            <h5 class="text-base font-semibold text-gray-500 dark:text-gray-100">Notifications</h5>

            @if($notifications->count())
                <div class="bg-slate-50 dark:bg-gray-900 shadow-md sm:rounded-md p-3 space-y-3">
                    @foreach($notifications as $notification)
                        <div class="flex items-center justify-between w-full">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('storage/uploads/residents/' . $notification->data['actor_image']) }}"
                                        alt="{{ $notification->data['actor_name'] ?? 'System' }}"
                                        class="w-8 h-8 rounded-full object-cover">
                                    <h6 class="font-semibold text-sm m-0">
                                        {{ $notification->data['actor_name'] ?? 'System' }}
                                    </h6>
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="text-sm text-gray-700">
                                        {{ $notification->data['message'] ?? 'No message' }}
                                    </a>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No notifications found.</p>
            @endif
        </div>
    </div>
</x-app-layout>