@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700'
                : 'block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>


{{--<a href="#"--}}
{{--   @click="$event.preventDefault(); open = !open"--}}
{{--   class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"--}}
{{--   :class="{'bg-primary-100 dark:bg-primary': isActive || open}"--}}
{{--   role="button"--}}
{{--   aria-haspopup="true"--}}
{{--   :aria-expanded="(open || isActive) ? 'true' : 'false'"></a>--}}
