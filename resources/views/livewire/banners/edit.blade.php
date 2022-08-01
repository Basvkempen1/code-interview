@php
    /** @var \App\Models\Banner $banner */
@endphp
<div class="bg-white dark:bg-darker overflow-hidden px-8 pb-2 pt-4 mb-8 shadow-xl">
    <div class="relative overflow-auto">
        <form wire:submit.prevent="{{ ($isNewBanner) ? 'store' : 'update' }}">
            <div class="flex flex-wrap justify-between">
                <div class="w-full sm:w-1/2 sm:pr-4">
                    <div class="mb-4 w-full">
                        <label for="name" class="text-gray-800 dark:text-gray-200">{{ __('Name') }}</label>
                        <input wire:model.defer="selectedBanner.name"
                               type="text"
                               id="name"
                               name="name"
                               class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-left text-gray-700 dark:text-gray-200" for="categorySelect">Category/Categories</label>
                        <div class="relative flex w-full w-full">
                            <select wire:model.defer="selectedCategories" id="categorySelect"
                                    class="block w-full p-3 border border-gray-300 rounded cursor-pointer focus:outline-none" multiple>
                                @foreach($categories as $name => $id)
                                    <option value="{{ $id }}" class="dark:text-gray-700" {{ in_array($id, $selectedCategories) ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-left text-gray-700 dark:text-gray-200" for="tags">Tags</label>
                        <div class="relative flex">
                            <select wire:model.defer="selectedTags" id="tags"
                                    class="block w-full p-3 border border-gray-300 rounded cursor-pointer focus:outline-none" multiple>
                                @foreach($tags as $name => $id)
                                    <option value="{{ $id }}" class="dark:text-gray-700" {{ in_array($id, $selectedTags) ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="priority" class="text-gray-800 dark:text-gray-200">{{ __('Priority') }}</label>
                        <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                            <a data-action="decrement" class="bg-white text-gray-800 hover:text-gray-700 hover:bg-gray-200 h-full w-20 rounded-l cursor-pointer outline-none text-center border">
                                <span class="m-auto text-2xl">−</span>
                            </a>
                            <input wire:model.defer="selectedBanner.priority"
                                   type="number"
                                   id="priority"
                                   class="outline-none focus:outline-none text-center w-full bg-white font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none border-t border-b"
                                   name="custom-input-number"
                                   value="0">
                            <a data-action="increment" class="bg-white text-gray-600 hover:text-gray-700 hover:bg-gray-200 h-full w-20 rounded-r cursor-pointer text-center border">
                                <span class="m-auto text-2xl">+</span>
                            </a>
                        </div>
                        @error('selectedBanner.priority') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label for="image_desktop"
                               class="text-gray-800 dark:text-gray-200">{{ __('Image desktop') }}</label>
                        <input wire:model.defer="selectedBanner.image_desktop"
                               type="url"
                               name="image_desktop"
                               id="image_desktop"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.image_desktop') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label for="image_mobile" class="text-gray-800 dark:text-gray-200">{{ __('Image mobile') }}</label>
                        <input wire:model.defer="selectedBanner.image_mobile"
                               type="url"
                               name="image_mobile"
                               id="image_mobile"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.image_mobile') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label for="image_tablet" class="text-gray-800 dark:text-gray-200">{{ __('Image tablet') }}</label>
                        <input wire:model.defer="selectedBanner.image_tablet"
                               type="url"
                               name="image_tablet"
                               id="image_tablet"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.image_tablet') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:pl-4">
                    <div class="mt-1 mb-4 w-full">
                        <label for="show_counter">
                            {{ __('Counter') }}
                        </label>
                        <label class="block switch w-12 h-6 text-gray-800 dark:text-gray-200">
                        <input wire:model.defer="selectedBanner.show_counter"
                               type="checkbox"
                               name="show_counter"
                               id="show_counter">
                        <span class="slider rounded-full bg-primary-100 dark:bg-white"
                        ></span>
                        </label>
                        @error('selectedBanner.show_counter') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label for="counter_text" class="text-gray-800 dark:text-gray-200">{{ __('Counter text') }}</label>
                        <input wire:model.defer="selectedBanner.counter_text"
                               type="text"
                               name="counter_text"
                               id="counter_text"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.counter_text') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <span>{{ __('Counter Example') }}</span>
                        <div id="counter-example-background" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text">{{ __('Counter Example') }}</span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex mb-4 mr-2 w-full">
                            <a class="flex items-center hover:cursor-pointer justify-center w-full max-w-2xl ml-auto px-4 py-2 mb-4 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark mx-auto font-bold text-base" id="showBlindColors">Show colorblind colors</a>
                        </div>
                        <div class="flex mb-4 ml-auto hidden">
                            <a class="hover:cursor-pointer bg-black font-bold rounded py-2 px-4 hidden" id="updateBlindColors" wire:click="colors('#00ff00', '#0000ff')">Update colorblind colors</a>
                        </div>
                    </div>
                    {{-- Colorblind color examples--}}
                    <div id="colorblindDivs" class="mb-4 w-full hidden">
                        {{-- Protanomaly --}}
                        Protanomaly
                        <div id="counter-example-background-protanomaly" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-protanomaly">{{ __('Counter Example') }}</span>
                        </div>
                        Protanopia
                        <div id="counter-example-background-protanopia" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-protanopia">{{ __('Counter Example') }}</span>
                        </div>
                        Deuteranomaly
                        <div id="counter-example-background-deuteranomaly" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-deuteranomaly">{{ __('Counter Example') }}</span>
                        </div>
                        Deuteranopia
                        <div id="counter-example-background-deuteranopia" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-deuteranopia">{{ __('Counter Example') }}</span>
                        </div>
                        Tritanomaly
                        <div id="counter-example-background-tritanomaly" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-tritanomaly">{{ __('Counter Example') }}</span>
                        </div>
                        Tritanopia
                        <div id="counter-example-background-tritanopia" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-tritanopia">{{ __('Counter Example') }}</span>
                        </div>
                        Achromatomaly
                        <div id="counter-example-background-achromatomaly" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-achromatomaly">{{ __('Counter Example') }}</span>
                        </div>
                        Achromatopsia
                        <div id="counter-example-background-achromatopsia" class="h-12 rounded-b-lg text-center">
                            <span class="px-4 font-bold inline-block" style="line-height: 3rem;" id="counter-example-text-achromatopsia">{{ __('Counter Example') }}</span>
                        </div>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="counter_text_color"
                               class="text-gray-800 dark:text-gray-200">{{ __('Counter text color') }}</label>
                        <input wire:model.defer="selectedBanner.counter_text_color"
                               type="color"
                               name="counter_text_color"
                               id="counter_text_color"
                               class="form-control block w-full text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.counter_text_color') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label for="counter_background_color"
                               class="text-gray-800 dark:text-gray-200">{{ __('Counter background color') }}</label>
                        <input wire:model.defer="selectedBanner.counter_background_color"
                               type="color"
                               name="counter_background_color"
                               id="counter_background_color"
                               class="form-control block w-full text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.counter_background_color') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 w-full">
                        <label for="date_from" class="text-gray-800 dark:text-gray-200">
                            {{ __('Select a start date') }}
                        </label>
                        <input wire:model.defer="selectedBanner.date_from"
                               type="datetime-local"
                               step="1"
                               name="date_from"
                               id="date_from"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.date_from') <span class="error">{{ $message }}</span> @enderror
                        <button class="datepicker-toggle-button" data-mdb-toggle="datepicker">
                            <i class="fas fa-calendar datepicker-toggle-icon"></i>
                        </button>
                    </div>
                    <div class="mb-4 w-full">
                        <label for="date_till"
                               class="text-gray-800 dark:text-gray-200">{{ __('Select an end date') }}</label>
                        <input wire:model.defer="selectedBanner.date_till"
                               type="datetime-local"
                               step="1"
                               name="date_till"
                               id="date_till"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        @error('selectedBanner.date_till') <span class="error">{{ $message }}</span> @enderror
                        <button class="datepicker-toggle-button" data-mdb-toggle="datepicker">
                            <i class="fas fa-calendar datepicker-toggle-icon"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button
                type="submit"
                class="flex items-center justify-center w-full max-w-2xl ml-auto px-4 py-2 mb-4 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark mx-auto font-bold text-base">
                {{ __('Save') }}
            </button>
        </form>
    </div>
</div>


<script>

    // Counter example & colorblind examples
    document.getElementById("counter-example-background").style.backgroundColor = document.getElementById("counter_background_color").value;
    document.getElementById("counter-example-text").style.color = document.getElementById("counter_text_color").value;

    document.getElementById("counter_background_color").addEventListener("input", function() {
        document.getElementById('counter-example-background').style.backgroundColor = this.value;
        document.getElementById('updateBlindColors').setAttribute('wire:click', "colors('" + this.value + "', '" + document.getElementById("counter_text_color").value + "')");
    });

    document.getElementById("counter_text_color").addEventListener("input", function() {
        document.getElementById("counter-example-text").style.color = this.value;
        document.getElementById('updateBlindColors').setAttribute('wire:click', "colors('" + document.getElementById("counter_background_color").value + "', '" + this.value + "')");
    });

    document.getElementById("counter_text").addEventListener("input", function() {
       document.getElementById("counter-example-text").innerText = this.value;
    });

    const delay = (time) => {
        return new Promise(resolve => setTimeout(resolve, time));
    }

    document.getElementById('showBlindColors').addEventListener('click', async function() {
        document.getElementById('updateBlindColors').click(); // Simulate click on update colors
        await delay(250); // This prevents the examples from disappearing because of the component refreshing
        let colors = JSON.parse(window.localStorage.getItem('colors'));
        document.getElementById('colorblindDivs').classList.remove('hidden');
        setCounterExampleColors(colors.original.backgroundColor, colors.original.textColor);
        setAllColourBlindColours(colors);
    })

    const setAllColourBlindColours = (colors) => {
        setProtanomalyColors(colors.protanomaly.backgroundColor, colors.protanomaly.textColor);
        setProtanopiaColors(colors.protanopia.backgroundColor, colors.protanopia.textColor);
        setDeuteranomalyColors(colors.deuteranomaly.backgroundColor, colors.deuteranomaly.textColor);
        setDeuteranopiaColors(colors.deuteranopia.backgroundColor, colors.deuteranopia.textColor);
        setTritanomalyColors(colors.tritanomaly.backgroundColor, colors.tritanomaly.textColor);
        setTritanopialyColors(colors.tritanopia.backgroundColor, colors.tritanopia.textColor);
        setAchromatomalyColors(colors.achromatomaly.backgroundColor, colors.achromatomaly.textColor);
        setAchromatopsiaColors(colors.achromatopsia.backgroundColor, colors.achromatopsia.textColor);
    }

    const setCounterExampleColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text").style.color = textColor;
    }

    const setProtanomalyColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-protanomaly').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-protanomaly").style.color = textColor;
    }
    const setProtanopiaColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-protanopia').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-protanopia").style.color = textColor;
    }
    const setDeuteranomalyColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-deuteranomaly').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-deuteranomaly").style.color = textColor;
    }
    const setDeuteranopiaColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-deuteranopia').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-deuteranopia").style.color = textColor;
    }
    const setTritanomalyColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-tritanomaly').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-tritanomaly").style.color = textColor;
    }
    const setTritanopialyColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-tritanopia').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-tritanopia").style.color = textColor;
    }
    const setAchromatomalyColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-achromatomaly').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-achromatomaly").style.color = textColor;
    }
    const setAchromatopsiaColors = (backgroundColor, textColor) => {
        document.getElementById('counter-example-background-achromatopsia').style.backgroundColor = backgroundColor;
        document.getElementById("counter-example-text-achromatopsia").style.color = textColor;
    }


    // Increment & decrement priority
    function decrement(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
            'a[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value--;
        target.value = value;
    }

    function increment(e) {
        const btn = e.target.parentNode.parentElement.querySelector(
            'a[data-action="decrement"]'
        );
        const target = btn.nextElementSibling;
        let value = Number(target.value);
        value++;
        target.value = value;
    }

    const decrementButtons = document.querySelectorAll(
        `a[data-action="decrement"]`
    );

    const incrementButtons = document.querySelectorAll(
        `a[data-action="increment"]`
    );

    decrementButtons.forEach(btn => {
        btn.addEventListener("click", decrement);
    });

    incrementButtons.forEach(btn => {
        btn.addEventListener("click", increment);
    });
</script>
