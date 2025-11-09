<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-1.5 py-1 bg-gray-800 dark:bg-gray-200 !border-[#6D0512] border-transparent rounded-md text-sm text-white tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>