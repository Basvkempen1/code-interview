<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white dark:bg-secondary rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
