@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-green-400 text-start text-base font-medium text-green-600 bg-gray-50 focus:outline-none focus:text-green-800 focus:bg-indigo-100 focus:border-green-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-green-600 hover:text-green-800 hover:bg-green-50 hover:border-green-300 focus:outline-none focus:text-green-800 focus:bg-green-50 focus:border-green-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
