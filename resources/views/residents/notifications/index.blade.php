@section('title') {{ 'Notifications' }} @endsection

<x-resident-layout>
    <div class="max-w-5xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="py-3">
            <h5 class="text-base font-semibold text-gray-500 dark:text-gray-100">Notifications</h5>

            @if($notifications->count())
                <div class="bg-slate-50 dark:bg-gray-900 shadow-md sm:rounded-md p-3 space-y-3">
                    @foreach($notifications as $notification)
                        <div class="flex items-center justify-between w-full">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('storage/uploads/users/' . $notification->data['actor_image']) }}"
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
                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            @else
                <p class="text-gray-600">No notifications found.</p>
            @endif
        </div>
    </div>
</x-resident-layout>