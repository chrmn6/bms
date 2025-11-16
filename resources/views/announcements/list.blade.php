<div class="space-y-6 sm:space-y-4">
    @foreach($announcements as $announcement)
        <div class="flex gap-3 sm:gap-6">
            {{-- Date Column --}}
            <div class="w-16 flex-shrink-0 pt-1 sm:w-24 text-center">
                <div class="text-gray-800 text-xs font-medium sm:text-sm">
                    {{ $announcement->created_at->format('M d') }}
                </div>
                <div class="text-gray-500 text-[10px] sm:text-xs">
                    {{ $announcement->created_at->format('D') }}
                </div>
            </div>
            {{-- Timeline Line --}}
            <div class="relative flex flex-col items-center">
                <div class="h-3 w-3 rounded-full bg-[#6D0512]"></div>
            </div>
            {{-- Announcement Card --}}
            <div class="relative bg-slate-50 border border-gray-200 py-3 px-6 rounded-2xl shadow-md flex flex-1 flex-col cursor-pointer hover:scale-[1.02] hover:shadow-lg transition-all duration-200 ease-in-out"
                hx-get="{{ route('announcements.show', $announcement) }}" hx-target="#announcementModalBody"
                hx-swap="innerHTML" hx-trigger="click" data-bs-toggle="modal" data-bs-target="#announcementModal"
                id="announcement-{{ $announcement->announcement_id }}">
                {{-- Action Buttons (Top Right) --}}
                <div class="absolute top-3 right-3 flex gap-1.5">
                    @can('update', $announcement)
                        <x-primary-button hx-get="{{ route('announcements.edit', $announcement) }}"
                            hx-target="#announcementModalBody" hx-swap="innerHTML" data-bs-toggle="modal"
                            data-bs-target="#announcementModal" onclick="event.stopPropagation();"
                            class="!bg-yellow-500 hover:!bg-yellow-600 active:!bg-yellow-700 flex items-center justify-center">
                            <svg class="w-[15px] h-[15px] text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                            </svg>
                        </x-primary-button>
                    @endcan

                    @can('delete', $announcement)
                        <form method="POST" class="inline-flex items-center m-0 p-0"
                            hx-delete="{{ route('announcements.destroy', $announcement) }}"
                            hx-target="#announcement-{{ $announcement->id }}" hx-swap="outerHTML"
                            onsubmit="event.stopPropagation(); return confirm('Are you sure you want to delete this announcement?');">
                            @csrf
                            @method('DELETE')
                            <x-primary-button type="submit"
                                class="!bg-red-500 !hover:bg-red-600 !active:bg-red-700 flex items-center justify-center">
                                <svg class="w-[15px] h-[15px] text-white dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                            </x-primary-button>
                        </form>
                    @endcan
                </div>

                {{-- Card Content --}}
                <div class="flex flex-col justify-between">
                    <div class="flex flex-col gap-1">
                        {{-- Time and Status --}}
                        <div class="flex items-center gap-1 mb-1">
                            <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <small class="text-gray-500 text-xs">
                                {{ $announcement->created_at->diffForHumans() }}
                            </small>
                        </div>
                        {{-- Title --}}
                        <div>
                            <h3 class="text-gray-900 text-lg font-bold leading-tight">
                                {{ $announcement->title }}
                            </h3>
                            <p class="text-gray-700 text-sm line-clamp-4 sm:line-clamp-6">
                                {!! nl2br(e($announcement->content)) !!}
                            </p>
                            {{-- Author --}}
                            <div class="text-gray-500 text-sm flex items-center gap-2 mt-1">
                                <i class="bi bi-person-fill"></i>
                                <span>By {{ $announcement->user->first_name }} {{ $announcement->user->last_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>