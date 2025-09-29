@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'block pl-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-gray-800 font-medium transition duration-150 ease-in-out'
        : 'block pl-4 py-2 border-l-4 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>