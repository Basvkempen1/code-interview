<div>
    <h1 class="text-lg text-gray-900 dark:text-white font-extrabold mb-5">{{ !empty($product->local_name) ? $product->local_name : $product->naam }}</h1>
    <div class="relative rounded-xl overflow-auto">
        <div class="table border-collapse table-auto w-full text-sm">
            <div class="table-header-group">
                <div class="table-row">
                    <div
                        class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('New price') }}</div>
                    <div
                        class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Old price') }}</div>
                    <div
                        class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Price type') }}</div>
                    <div
                        class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('Date') }}</div>
                    <div
                        class="table-cell border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">{{ __('User') }}</div>
                </div>
            </div>
            <div class="table-row-group bg-white dark:bg-slate-800">
                @foreach($product->priceMutations->sortByDesc('created_at') as $priceMutation)
                    <div class="table-row">
                        <div
                            class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            <span class="pr-3{{ $priceMutation->went_up ? ' text-green-500' : ' text-red-500' }}">{!! $priceMutation->went_up ? '&uarr;' : '&darr;' !!}</span>
                            &euro; {{ number_format($priceMutation->new_price / 100, 2, ',', '.') }}</div>
                        <div
                            class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                            &euro; {{ number_format($priceMutation->old_price / 100, 2, ',', '.') }}</div>
                        <div
                            class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $priceMutation->price_type }}</div>
                        <div
                            class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ $priceMutation->created_at->format('d-m-Y H:i:s') }}</div>
                        <div
                            class="table-cell border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ \App\Models\User::find($priceMutation->user_id)->name }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
