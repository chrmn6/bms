<div class="{{ $cardBg }} rounded-md border-0 cursor-pointer transition-all duration-200 ease-in-out hover:shadow-md"
    style="width: 180px; height: 85px; padding: 15px;">

    <div class="flex items-start gap-3 h-full">
        <div class="w-9 h-9 flex items-center justify-center rounded-xl {{ $iconColor }}">
            {{ $slot }}
        </div>

        <div class="flex flex-col justify-center">
            <span class="text-base font-bold {{ $textColor }} mb-1">
                {{ $label }}
            </span>
            <div class="text-xl text-center font-bold {{ $textColor }} stat-number" data-count="{{ $count }}">
                0
            </div>
        </div>
    </div>

</div>