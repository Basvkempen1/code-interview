<nav x-data="{ open: false }" aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
    <!-- Primary Navigation Menu -->
    <div x-data="{ isActive: true, open: true}">
        <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
        <a
            href="#"
            @click="$event.preventDefault(); open = !open"
            class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
            :class="{'bg-primary-100 dark:bg-primary': isActive || open}"
            role="button"
            aria-haspopup="true"
            :aria-expanded="(open || isActive) ? 'true' : 'false'"
        >
                  <span aria-hidden="true">
                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                      <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                      />
                    </svg>
                  </span>
            <span class="ml-2 text-sm"> Dashboards </span>
            <span class="ml-auto" aria-hidden="true">
                    <!-- active class 'rotate-180' -->
                    <svg
                        class="w-4 h-4 transition-transform transform"
                        :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </span>
        </a>
        <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
            <!-- active & hover classes 'text-gray-700 dark:text-light' -->
            <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
{{--            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
{{--            </div>--}}
        </div>
{{--    </div>--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex">--}}
{{--                <!-- Logo -->--}}
{{--                <div class="shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('dashboard') }}">--}}
{{--                        <x-jet-application-mark class="block h-9 w-auto" />--}}
{{--                    </a>--}}
{{--                </div>--}}

                <!-- Navigation Links -->

{{--            </div>--}}

{{--            <div class="hidden sm:flex sm:items-center sm:ml-6">--}}
                <!-- Teams Dropdown -->


                <!-- Settings Dropdown -->
{{--                <div class="ml-3 relative">--}}
{{--                    <x-jet-dropdown align="right" width="48">--}}
{{--                        <x-slot name="trigger">--}}
{{--                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())--}}
{{--                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">--}}
{{--                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />--}}
{{--                                </button>--}}
{{--                            @else--}}
{{--                                <span class="inline-flex rounded-md">--}}
{{--                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">--}}
{{--                                        {{ Auth::user()->name }}--}}

{{--                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">--}}
{{--                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
{{--                                </span>--}}
{{--                            @endif--}}
{{--                        </x-slot>--}}

{{--                        <x-slot name="content">--}}
{{--                            <!-- Account Management -->--}}
{{--                            <div class="block px-4 py-2 text-xs text-gray-400">--}}
{{--                                {{ __('Manage Account') }}--}}
{{--                            </div>--}}

{{--                            <x-jet-dropdown-link href="{{ route('profile.show') }}">--}}
{{--                                {{ __('Profile') }}--}}
{{--                            </x-jet-dropdown-link>--}}

{{--                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())--}}
{{--                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">--}}
{{--                                    {{ __('API Tokens') }}--}}
{{--                                </x-jet-dropdown-link>--}}
{{--                            @endif--}}

{{--                            <div class="border-t border-gray-100"></div>--}}

{{--                            <!-- Authentication -->--}}
{{--                            <form method="POST" action="{{ route('logout') }}" x-data>--}}
{{--                                @csrf--}}

{{--                                <x-jet-dropdown-link href="{{ route('logout') }}"--}}
{{--                                         @click.prevent="$root.submit();">--}}
{{--                                    {{ __('Log Out') }}--}}
{{--                                </x-jet-dropdown-link>--}}
{{--                            </form>--}}
{{--                        </x-slot>--}}
{{--                    </x-jet-dropdown>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
{{--        </div>--}}
        <!-- Marketing links -->
        <div x-data="{ isActive: false, open: false }">
            <!-- active classes 'bg-primary-100 dark:bg-primary' -->
            <a
                href="#"
                @click="$event.preventDefault(); open = !open"
                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
                role="button"
                aria-haspopup="true"
                :aria-expanded="(open || isActive) ? 'true' : 'false'"
            >
                  <span aria-hidden="true">
                    <svg
                        class="w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                      <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                      />
                    </svg>
                  </span>
                <span class="ml-2 text-sm"> Marketing </span>
                <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                        class="w-4 h-4 transition-transform transform"
                        :class="{ 'rotate-180': open }"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                  </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Marketing">
                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                <a
                    href="{{ route('marketing.banners.index') }}"
                    role="menuitem"
                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"
                >
                    Banners
                </a>
            </div>
        </div>

{{--        <!-- Pages links -->--}}
{{--        <div x-data="{ isActive: false, open: false }">--}}
{{--            <!-- active classes 'bg-primary-100 dark:bg-primary' -->--}}
{{--            <a--}}
{{--                href="#"--}}
{{--                @click="$event.preventDefault(); open = !open"--}}
{{--                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"--}}
{{--                :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"--}}
{{--                role="button"--}}
{{--                aria-haspopup="true"--}}
{{--                :aria-expanded="(open || isActive) ? 'true' : 'false'"--}}
{{--            >--}}
{{--                  <span aria-hidden="true">--}}
{{--                    <svg--}}
{{--                        class="w-5 h-5"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                        fill="none"--}}
{{--                        viewBox="0 0 24 24"--}}
{{--                        stroke="currentColor"--}}
{{--                    >--}}
{{--                      <path--}}
{{--                          stroke-linecap="round"--}}
{{--                          stroke-linejoin="round"--}}
{{--                          stroke-width="2"--}}
{{--                          d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"--}}
{{--                      />--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--                <span class="ml-2 text-sm"> Pages </span>--}}
{{--                <span aria-hidden="true" class="ml-auto">--}}
{{--                    <!-- active class 'rotate-180' -->--}}
{{--                    <svg--}}
{{--                        class="w-4 h-4 transition-transform transform"--}}
{{--                        :class="{ 'rotate-180': open }"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                        fill="none"--}}
{{--                        viewBox="0 0 24 24"--}}
{{--                        stroke="currentColor"--}}
{{--                    >--}}
{{--                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--            </a>--}}
{{--            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">--}}
{{--                <!-- active & hover classes 'text-gray-700 dark:text-light' -->--}}
{{--                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->--}}
{{--                <a--}}
{{--                    href="pages/blank.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Blank--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="pages/404.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    404--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="pages/500.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    500--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="#"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Profile (soon)--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="#"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Pricing (soon)--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="#"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Kanban (soon)--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="#"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Feed (soon)--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Authentication links -->--}}
{{--        <div x-data="{ isActive: false, open: false}">--}}
{{--            <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->--}}
{{--            <a--}}
{{--                href="#"--}}
{{--                @click="$event.preventDefault(); open = !open"--}}
{{--                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"--}}
{{--                :class="{'bg-primary-100 dark:bg-primary': isActive || open}"--}}
{{--                role="button"--}}
{{--                aria-haspopup="true"--}}
{{--                :aria-expanded="(open || isActive) ? 'true' : 'false'"--}}
{{--            >--}}
{{--                  <span aria-hidden="true">--}}
{{--                    <svg--}}
{{--                        class="w-5 h-5"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                        fill="none"--}}
{{--                        viewBox="0 0 24 24"--}}
{{--                        stroke="currentColor"--}}
{{--                    >--}}
{{--                      <path--}}
{{--                          stroke-linecap="round"--}}
{{--                          stroke-linejoin="round"--}}
{{--                          stroke-width="2"--}}
{{--                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"--}}
{{--                      />--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--                <span class="ml-2 text-sm"> Authentication </span>--}}
{{--                <span aria-hidden="true" class="ml-auto">--}}
{{--                    <!-- active class 'rotate-180' -->--}}
{{--                    <svg--}}
{{--                        class="w-4 h-4 transition-transform transform"--}}
{{--                        :class="{ 'rotate-180': open }"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                        fill="none"--}}
{{--                        viewBox="0 0 24 24"--}}
{{--                        stroke="currentColor"--}}
{{--                    >--}}
{{--                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--            </a>--}}
{{--            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">--}}
{{--                <!-- active & hover classes 'text-gray-700 dark:text-light' -->--}}
{{--                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->--}}
{{--                <a--}}
{{--                    href="auth/register.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Register--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="auth/login.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Login--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="auth/forgot-password.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Forgot Password--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="auth/reset-password.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Reset Password--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Layouts links -->--}}
{{--        <div x-data="{ isActive: false, open: false}">--}}
{{--            <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->--}}
{{--            <a--}}
{{--                href="#"--}}
{{--                @click="$event.preventDefault(); open = !open"--}}
{{--                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"--}}
{{--                :class="{'bg-primary-100 dark:bg-primary': isActive || open}"--}}
{{--                role="button"--}}
{{--                aria-haspopup="true"--}}
{{--                :aria-expanded="(open || isActive) ? 'true' : 'false'"--}}
{{--            >--}}
{{--                  <span aria-hidden="true">--}}
{{--                    <svg--}}
{{--                        class="w-5 h-5"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                        fill="none"--}}
{{--                        viewBox="0 0 24 24"--}}
{{--                        stroke="currentColor"--}}
{{--                    >--}}
{{--                      <path--}}
{{--                          stroke-linecap="round"--}}
{{--                          stroke-linejoin="round"--}}
{{--                          stroke-width="2"--}}
{{--                          d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"--}}
{{--                      />--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--                <span class="ml-2 text-sm"> Layouts </span>--}}
{{--                <span aria-hidden="true" class="ml-auto">--}}
{{--                    <!-- active class 'rotate-180' -->--}}
{{--                    <svg--}}
{{--                        class="w-4 h-4 transition-transform transform"--}}
{{--                        :class="{ 'rotate-180': open }"--}}
{{--                        xmlns="http://www.w3.org/2000/svg"--}}
{{--                        fill="none"--}}
{{--                        viewBox="0 0 24 24"--}}
{{--                        stroke="currentColor"--}}
{{--                    >--}}
{{--                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>--}}
{{--                    </svg>--}}
{{--                  </span>--}}
{{--            </a>--}}
{{--            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Layouts">--}}
{{--                <!-- active & hover classes 'text-gray-700 dark:text-light' -->--}}
{{--                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->--}}
{{--                <a--}}
{{--                    href="layouts/two-columns-sidebar.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Two Columns Sidebar--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="layouts/mini-plus-one-columns-sidebar.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Mini + One Columns Sidebar--}}
{{--                </a>--}}
{{--                <a--}}
{{--                    href="layouts/mini-column-sidebar.html"--}}
{{--                    role="menuitem"--}}
{{--                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700"--}}
{{--                >--}}
{{--                    Mini Column Sidebar--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
        {{--                </nav>--}}

        <!-- Sidebar footer -->
        <div class="flex-shrink-0 px-2 py-4 space-y-2">
            <button
                @click="openSettingsPanel"
                type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-sm text-white rounded-md bg-primary hover:bg-primary-dark focus:outline-none focus:ring focus:ring-primary-dark focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark"
            >
                <span aria-hidden="true">
                  <svg
                      class="w-4 h-4 mr-2"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                  >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                    />
                  </svg>
                </span>
                <span>Customize</span>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="pt-2 pb-3 space-y-1">--}}
{{--            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">--}}
{{--                {{ __('Dashboard') }}--}}
{{--            </x-jet-responsive-nav-link>--}}
{{--        </div>--}}

{{--        <!-- Responsive Settings Options -->--}}
{{--        <div class="pt-4 pb-1 border-t border-gray-200">--}}
{{--            <div class="flex items-center px-4">--}}
{{--                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())--}}
{{--                    <div class="shrink-0 mr-3">--}}
{{--                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div>--}}
{{--                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>--}}
{{--                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-3 space-y-1">--}}
{{--                <!-- Account Management -->--}}
{{--                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">--}}
{{--                    {{ __('Profile') }}--}}
{{--                </x-jet-responsive-nav-link>--}}

{{--                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())--}}
{{--                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">--}}
{{--                        {{ __('API Tokens') }}--}}
{{--                    </x-jet-responsive-nav-link>--}}
{{--                @endif--}}

{{--                <!-- Authentication -->--}}
{{--                <form method="POST" action="{{ route('logout') }}" x-data>--}}
{{--                    @csrf--}}

{{--                    <x-jet-responsive-nav-link href="{{ route('logout') }}"--}}
{{--                                   @click.prevent="$root.submit();">--}}
{{--                        {{ __('Log Out') }}--}}
{{--                    </x-jet-responsive-nav-link>--}}
{{--                </form>--}}

{{--                <!-- Team Management -->--}}
{{--                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())--}}
{{--                    <div class="border-t border-gray-200"></div>--}}

{{--                    <div class="block px-4 py-2 text-xs text-gray-400">--}}
{{--                        {{ __('Manage Team') }}--}}
{{--                    </div>--}}

{{--                    <!-- Team Settings -->--}}
{{--                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">--}}
{{--                        {{ __('Team Settings') }}--}}
{{--                    </x-jet-responsive-nav-link>--}}

{{--                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())--}}
{{--                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">--}}
{{--                            {{ __('Create New Team') }}--}}
{{--                        </x-jet-responsive-nav-link>--}}
{{--                    @endcan--}}

{{--                    <div class="border-t border-gray-200"></div>--}}

{{--                    <!-- Team Switcher -->--}}
{{--                    <div class="block px-4 py-2 text-xs text-gray-400">--}}
{{--                        {{ __('Switch Teams') }}--}}
{{--                    </div>--}}

{{--                    @foreach (Auth::user()->allTeams() as $team)--}}
{{--                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</nav>
