<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark']) }}>
    {{ $slot }}
</button>
