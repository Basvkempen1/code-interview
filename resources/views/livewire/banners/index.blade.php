<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($selectedBanner)
        <div class="dark:bg-darker mb-6 overflow-hidden">
            @include('livewire.banners.edit')
        </div>
    @endif
    <div
        class="table-cell border-b border-slate-100 dark:border-slate-700 mb-4 text-slate-500 dark:text-slate-400">
        <button wire:click="create()" type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
            Add
        </button>
    </div>
    <div class="bg-white dark:bg-darker overflow-hidden shadow-xl mt-4">
        <div class="relative rounded-xl overflow-auto">
            @include('livewire.banners.list')
        </div>
    </div>
</div>
