<div class="{{ $cardBg }} rounded-md border-0 cursor-pointer transition-all duration-200 ease-in-out hover:shadow-md"
    style="width: 220px; height: 100px; padding: 15px;">

    <div class="flex justify-between h-full">
        <div class="flex flex-col items-start gap-3">
            <div class="w-9 h-12 p-1 flex items-center justify-center rounded-md {{ $iconColor }}">
                {{ $slot }}
            </div>
            <span class="text-base font-bold {{ $textColor }}">
                {{ $label }}
            </span>
        </div>

        <div class="text-2xl font-bold {{ $textColor }} stat-number text-right" data-count="{{ $count }}">
            0
        </div>
    </div>

</div>