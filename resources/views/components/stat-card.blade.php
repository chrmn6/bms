<div class="bg-neutral-50 shadow rounded-md relative cursor-pointer transition-all duration-200 ease-in-out"
    style="width: 185px; height: 80px; padding: 10px;">

    <div class="flex items-center gap-4">
        <!-- Icon on the left -->
        <div class="w-9 h-9 flex items-center justify-center rounded-md {{ $bgColor }}">
            {{ $slot }}
        </div>

        <!-- Label and Count stacked vertically on the right -->
        <div class="flex flex-col">
            <span class="text-sm font-bold text-black">
                {{ $label }}
            </span>
            <div class="text-xl text-center font-semibold text-slate-500 stat-number" data-count="{{ $count }}">
                0
            </div>
        </div>
    </div>

</div>