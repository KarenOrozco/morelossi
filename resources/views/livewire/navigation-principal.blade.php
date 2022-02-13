<div class="bg-white">
    {{-- <h1 class="text-4xl text-center tracking-tight font-extrabold sm:text-5xl md:text-6xl">
        <span class="inline">Morelos</span><span class="text-indigo-400 inline">Sí</span>
    </h1> --}}
    <a href="{{route('principal')}}">
        <img class="m-auto w-2/5 md:w-3/12" src="{{ asset('storage/logotipo/morelossi.png') }}">
    </a>
</div>

{{-- from-pink-700 via-red-400 to-pink-800 --}}
<div class="sticky top-0 z-50 bg-gradient-to-r text-white bg-rose-500 shadow-md py-2 md:py-4 sm:px-6 lg:px-8" x-data="{showMenu:false}" @click.away="showMenu=false">
    <nav class="relative px-4 flex items-center justify-center sm:h-10" aria-label="Global">
        <div class="flex items-center flex-grow flex-shrink-0 md:flex-grow-0">
            <div class="flex items-center justify-center w-full md:w-auto">
                {{-- icono/logo --}}
                {{-- <a href="#" class="md:hidden">
                    <span class="sr-only">Workflow</span>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
                </a> --}}

                {{-- botón hamburguesa --}}
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button"
                        class="rounded-md p-2 inline-flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                        aria-controls="mobile-menu" aria-expanded="false" @click.prevent="showMenu=!showMenu">
                        <span class="sr-only">Open main menu</span>
                        <!-- Heroicon name: outline/menu -->
                        {{-- <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg> --}}

                        <i x-show="!showMenu" class="mdi mdi-menu mdi-24px"></i> </span>
                        <i x-show="showMenu" class="mdi mdi-close mdi-24px"></i> </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden md:block md:mx-3 md:p-4 md:space-x-4 space-x-reverse">
            <ul>
                {{--  x-data="{ selected : 'morelossi' }" :class="'bg-yellow-900': selected === 'morelossi'" --}}
                <li class="dropdown inline-block relative">
                    <a href="{{route('principal')}}"
                        x-on:click="selected = 'morelossi'"
                        class="font-medium h-10 leading-10 px-4 py-2 rounded cursor-pointer no-underline transition-colors duration-100 hover:bg-pink-300 hover:bg-opacity-25 {{ request()->routeIs('about') ? 'bg-pink-300 bg-opacity-25' : ''}}">MorelosSí
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div>
                        <ul class="dropdown-menu z-10 absolute hidden pt-1">
                            <li class=""><a class="rounded bg-pink-600 hover:bg-opacity-90 py-2 px-4 block whitespace-no-wrap {{ request()->routeIs('about') ? 'bg-opacity-95' : ''}}" href="{{route('about')}}">¿Quienes somos?</a></li>
                        </ul>
                    </div>
                
                </li>
                
                <li class="inline-block">
                    <a href="{{route('directory')}}"
                    class="font-medium h-10 leading-10 px-4 py-2 rounded cursor-pointer no-underline transition-colors duration-100 hover:bg-pink-300 hover:bg-opacity-25 {{ request()->routeIs('directory') ? 'bg-pink-300 bg-opacity-25' : ''}}">Buscador</a>
                </li>
                
                <li class="inline-block">
                    <a href="{{route('companies.create')}}"
                        class="font-medium h-10 leading-10 px-4 py-2 rounded cursor-pointer no-underline transition-colors duration-100 hover:bg-pink-300 hover:bg-opacity-25 {{ request()->routeIs('companies.create') ? 'bg-pink-300 bg-opacity-25' : ''}}">Afiliate</a>
                </li>

                <li class="inline-block">
                    <a href="{{route('events')}}"
                        class="font-medium h-10 leading-10 px-4 py-2 rounded cursor-pointer no-underline transition-colors duration-100 hover:bg-pink-300 hover:bg-opacity-25 {{ request()->routeIs('events') ? 'bg-pink-300 bg-opacity-25' : ''}}">Eventos</a>
                </li>

                <li class="inline-block">
                    <a href="{{route('contact')}}"
                        class="font-medium h-10 leading-10 px-4 py-2 rounded cursor-pointer no-underline transition-colors duration-100 hover:bg-pink-300 hover:bg-opacity-25 {{ request()->routeIs('contact') ? 'bg-pink-300 bg-opacity-25' : ''}}">Contacto</a>
                </li>

                {{-- <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 px-4 py-2">Log in</a> --}}

            </ul>
           
            
        </div>
    </nav>
    {{-- <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden" id="mobile-menu"
        x-show="showMenu">
        <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden"
            x-data="{showMenu:false}" @mouseleave="showMenu=false" @mouseenter="showMenu=true">
            <div class="px-5 pt-4 flex items-center justify-between">
                <div>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                </div>
                <div class="-mr-2">
                    <button type="button"
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        x-on:click="showMenu=false">
                        <span class="sr-only">Close main menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Product</a>

                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Features</a>

                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Marketplace</a>

                <a href="#"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Company</a>
            </div>
            <a href="#"
                class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                Log in
            </a>
        </div>
    </div> --}}

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu" x-show="showMenu">
        <div class="px-2 pt-2 pb-3 space-y-1" x-data="{showMenu:false}" @mouseleave="showMenu=false"
            @mouseenter="showMenu=true">
            <ul>
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <li class="block relative" x-data="{showSubmenu:false}" @click.away="showSubmenu=false">
                    <a href="{{route('principal')}}"
                        class="hover:bg-pink-300 hover:bg-opacity-25 block pl-8 px-3 py-2 rounded-md text-xl font-medium {{ request()->routeIs('about') ? 'bg-pink-300 bg-opacity-25' : ''}}"
                        @click.prevent="showSubmenu=!showSubmenu" aria-current="page">MorelosSí
                        <span class="ml-2">

                        <i x-show="!showSubmenu" class="mdi mdi-chevron-down"></i> </span>
                        <i x-show="showSubmenu" class="mdi mdi-chevron-up"></i> </span>
                    </a>

                    <div class="md:hidden" id="mobile-submenu" x-show="showSubmenu">
                        <ul class="list-reset">
                            <li class="block relative" x-data="{showSubmenu:false}" @mouseleave="showSubmenu=false"
                                @mouseenter="showSubmenu=true">
                                <!-- Active: " bg-gray-100", Not Active: "" -->
                                <a href="{{route('about')}}"
                                    class="hover:bg-pink-300 hover:bg-opacity-25 block pl-12 px-3 py-2 rounded-md text-xl {{ request()->routeIs('about') ? 'bg-pink-300 bg-opacity-25' : ''}}">
                                    ¿Quienes somos?
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="block relative">
                    <a href="{{route('directory')}}"
                        class="hover:bg-pink-300 hover:bg-opacity-25 block pl-8 px-3 py-2 rounded-md text-xl {{ request()->routeIs('directory') ? 'bg-pink-300 bg-opacity-25' : ''}}">Buscador</a>
                </li>

                <li class="block relative">
                    <a href="{{route('companies.create')}}"
                        class="hover:bg-pink-300 hover:bg-opacity-25 block pl-8 px-3 py-2 rounded-md text-xl font-medium {{ request()->routeIs('companies.create') ? 'bg-pink-300 bg-opacity-25' : ''}}">Afiliate</a>
                </li>

                <li class="block relative">
                    <a href="{{route('events')}}"
                        class="hover:bg-pink-300 hover:bg-opacity-25 block pl-8 px-3 py-2 rounded-md text-xl font-medium {{ request()->routeIs('events') ? 'bg-pink-300 bg-opacity-25' : ''}}">Eventos</a>
                </li>

                <li class="block relative">
                    <a href="{{route('contact')}}"
                        class="hover:bg-pink-300 hover:bg-opacity-25 block pl-8 px-3 py-2 rounded-md text-xl font-medium {{ request()->routeIs('contact') ? 'bg-pink-300 bg-opacity-25' : ''}}">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</div>




{{-- <div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <main class="mt-10 mx-auto max-w-7xl lg:pt-6 px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-0 lg:px-8">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Data to enrich your</span>
                        <span class="block text-indigo-600 xl:inline">online business</span>
                    </h1>
                    <p
                        class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit
                        sunt amet fugiat veniam occaecat fugiat aliqua.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="#"
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                Get started
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#"
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                Live demo
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
            src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
            alt="">
    </div>
</div> --}}

{{-- <div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <div>
                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                        aria-label="Global">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a href="#">
                                    <span class="sr-only">Workflow</span>
                                    <img class="h-8 w-auto sm:h-10"
                                        src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
                                </a>
                                <div class="-mr-2 flex items-center md:hidden">
                                    <button type="button"
                                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                        aria-expanded="false">
                                        <span class="sr-only">Open main menu</span>
                                        <!-- Heroicon name: outline/menu -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                            <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Product</a>

                            <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Features</a>

                            <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Marketplace</a>

                            <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Company</a>

                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>
                        </div>
                    </nav>
                </div>

                <!--
            Mobile menu, show/hide based on menu open state.
  
            Entering: "duration-150 ease-out"
              From: "opacity-0 scale-95"
              To: "opacity-100 scale-100"
            Leaving: "duration-100 ease-in"
              From: "opacity-100 scale-100"
              To: "opacity-0 scale-95"
          -->
                <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                    <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="px-5 pt-4 flex items-center justify-between">
                            <div>
                                <img class="h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                            </div>
                            <div class="-mr-2">
                                <button type="button"
                                    class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                    <span class="sr-only">Close main menu</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="px-2 pt-2 pb-3 space-y-1">
                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Product</a>

                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Features</a>

                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Marketplace</a>

                            <a href="#"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Company</a>
                        </div>
                        <a href="#"
                            class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                            Log in
                        </a>
                    </div>
                </div>
            </div>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Data to enrich your</span>
                        <span class="block text-indigo-600 xl:inline">online business</span>
                    </h1>
                    <p
                        class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit
                        sunt amet fugiat veniam occaecat fugiat aliqua.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="#"
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                Get started
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#"
                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                Live demo
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
            src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
            alt="">
    </div>
</div> --}}
