<div class="{{ $cardBg }} rounded-md border-0 cursor-pointer transition-all duration-200 ease-in-out hover:shadow-md"
    style="width: 200px; height: 80px; padding: 15px;">

    <div class="flex justify-between h-full">
        <div class="flex flex-col items-start gap-1">
            <div class="w-7 h-10 flex items-center justify-center rounded-md {{ $iconColor }}">
                {{ $slot }}
            </div>
            <span class="text-base font-bold {{ $textColor }}">
                {{ $label }}
            </span>
        </div>

        <div class="text-2xl font-bold {{ $textColor }} stat-number self-start" data-count="{{ $count }}">
            0
        </div>
    </div>

</div>