@php
    /** @var \App\Models\Banner $banner */
@endphp
<div class="table border-collapse table-auto w-full text-sm">
    <div class="table-header-group">
        <div class="table-row">
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Name') }}</div>
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Priority') }}</div>
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Counter') }}</div>
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Date from') }}</div>
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Date till') }}</div>
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left"></div>
            <div
                class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-4 pb-3 text-slate-400 dark:text-slate-200 text-left"></div>
        </div>
    </div>
    <div class="table-row-group bg-white dark:bg-slate-800">
        @foreach ($banners as $banner)
            <div class="table-row">
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $banner->name }}</div>
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $banner->priority }}</div>
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $banner->show_counter }}</div>
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $banner->date_from }}</div>
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $banner->date_till }}</div>
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                    <button wire:click="edit({{ $banner->id }})" type="button"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                        Edit
                    </button>
                </div>
                <div
                    class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                    <button wire:click="delete({{ $banner->id }})" type="button"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-red-600 hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
