<nav x-data="{showChildren:false}" @click.away="showChildren=false">

    {{-- <div class="container flex items-center justify-center px-6 py-8 mx-auto text-gray-600 capitalize"> --}}

    <div class="bg-yellow-50 p-6">
        <a class="block text-5xl font-bold text-center text-gray-800 dark:text-white lg:text-6xl hover:text-gray-700 dark:hover:text-gray-300"
            href="#">MorelosSí</a>
    </div>

    <div class="bg-gradient-to-r from-red-300 to-yellow-400">
        <div class="relative flex items-center justify-center h-16">
            <!-- Mobile menu button-->
            <div class="absolute flex items-center sm:hidden">
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-yellow-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                    aria-controls="mobile-menu" aria-expanded="false" @click.prevent="showChildren=!showChildren">
                    <span class="sr-only">Open main menu</span>
                    {{-- hover:text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-700 --}}
                    <!-- Icon when menu is closed. Heroicon name: outline/menu Menu open: "hidden", Menu closed: "block"-->
                    {{-- <svg  x-show="!showChildren" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg> --}}
                    <!-- Icon when menu is open. Heroicon name: outline/x Menu open: "block", Menu closed: "hidden"-->
                    {{-- <svg  x-show="!showChildren" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg> --}}

                    <i x-show="!showChildren" class="mdi mdi-menu mdi-24px"></i> </span>
                    <i x-show="showChildren" class="mdi mdi-close mdi-24px"></i> </span>
                </button>

            </div>

            {{-- Opciones del menú en pantalla grande --}}
            <div class="flex flex-wrap w-full sm:items-stretch sm:justify-center">
                <div class="hidden sm:block sm:ml-6">
                    <ul class="flex space-x-4">
                        <li class="block relative" x-data="{showChildren:false}" @click.away="showChildren=false">
                            {{-- <a href="#" class="border-b-2 border-transparent hover:text-gray-800 hover:border-blue-500 mx-1.5 sm:mx-6" @click.prevent="showChildren=!showChildren">
                                <span class="mr-3 text-xl"> <i class="mdi mdi-web"></i> </span>
                                <span>MorelosSí</span>
                                <span class="ml-2"> <i class="mdi mdi-chevron-down"></i> </span>
                            </a> --}}
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300 hover:bg-opacity-25"
                                @click.prevent="showChildren=!showChildren">
                                <span>MorelosSí</span>
                                <span class="ml-2"> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            {{-- submenú de una opción --}}
                            <div class="bg-white shadow-md rounded border border-gray-300 text-sm absolute top-auto left-0 min-w-full w-56 z-30 mt-1"
                                x-show="showChildren" x-transition:enter="transition ease duration-300 transform"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease duration-300 transform"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                <span
                                    class="absolute top-0 left-0 w-3 h-3 bg-white border transform rotate-45 -mt-1 ml-6"></span>
                                <div class="bg-white rounded w-full relative z-10 py-1">
                                    <ul class="list-reset">
                                        <li class="relative" x-data="{showChildren:false}"
                                            @mouseleave="showChildren=false" @mouseenter="showChildren=true">
                                            <a href="#"
                                                class="px-4 py-2 flex w-full items-start hover:bg-gray-100 no-underline hover:no-underline transition-colors duration-100 cursor-pointer">
                                                <span class="flex-1">¿Quienes somos?</span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="block relative">
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300 hover:bg-opacity-25">Buscador</a>
                        </li>
                        <li class="block relative">
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300 hover:bg-opacity-25">Afiliate</a>
                        </li>
                        <li class="block relative">
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300 hover:bg-opacity-25">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden bg-gradient-to-r from-red-300 to-yellow-400" id="mobile-menu" x-show="showChildren">
        <div class="px-2 pt-2 pb-3 space-y-1" x-data="{showChildren:false}" @mouseleave="showChildren=false"
            @mouseenter="showChildren=true">
            <ul>
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <li class="block relative" x-data="{showSubmenu:false}" @click.away="showSubmenu=false">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:bg-opacity-25 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl font-medium"
                        @click.prevent="showSubmenu=!showSubmenu" aria-current="page">MorelosSí
                        <span class="ml-2">

                            <i x-show="!showSubmenu" class="mdi mdi-chevron-down"></i> </span>

                        <i x-show="showSubmenu" class="mdi mdi-chevron-up"></i> </span>
                    </a>

                    <div class="sm:hidden" id="mobile-submenu" x-show="showSubmenu">
                        <ul class="list-reset">
                            <li class="block relative" x-data="{showSubmenu:false}" @mouseleave="showSubmenu=false"
                                @mouseenter="showSubmenu=true>
                                <!-- Active: " bg-gray-100", Not Active: "" -->
                                <a href="#"
                                    class="hover:bg-yellow-300 hover:bg-opacity-25 hover:text-white block pl-12 px-3 py-2 rounded-md text-xl">
                                    ¿Quienes somos?
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="block relative">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:bg-opacity-25 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl">Buscador</a>
                </li>

                <li class="block relative">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:bg-opacity-25 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl font-medium">Afiliate</a>
                </li>

                <li class="block relative">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:bg-opacity-25 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl font-medium">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
{{-- <nav class="shadow bg-yellow-50 " x-data="{showChildren:false}" @click.away="showChildren=false">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 container p-6 x-auto">
        <a class="block text-5xl font-bold text-center text-gray-800 dark:text-white lg:text-6xl hover:text-gray-700 dark:hover:text-gray-300"
            href="#">MorelosSí</a>
    </div>

    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gradient-to-r from-red-400 to-yellow-500">        
        <div class="relative flex items-center justify-center h-16">
            <div class="absolute flex items-center sm:hidden">
                <button type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-yellow-600 hover:text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-yellow-700"
                    aria-controls="mobile-menu" aria-expanded="false"  @click.prevent="showChildren=!showChildren">
                    <span class="sr-only">Open main menu</span>
                    <svg  x-show="!showChildren" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg  x-show="!showChildren" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    
                    <i x-show="showChildren" class="mdi mdi-close"></i> </span>
                </button>
                
            </div>

            <div class="flex flex-wrap w-full sm:items-stretch sm:justify-center">
                <div class="hidden sm:block sm:ml-6">
                    <ul class="flex space-x-4">
                        <li class="block relative" x-data="{showChildren:false}" @click.away="showChildren=false">
                            
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300"
                                @click.prevent="showChildren=!showChildren">
                                <span>MorelosSí</span>
                                <span class="ml-2"> <i class="mdi mdi-chevron-down"></i> </span>
                            </a>
                            <div class="bg-white shadow-md rounded border border-gray-300 text-sm absolute top-auto left-0 min-w-full w-56 z-30 mt-1"
                                x-show="showChildren" x-transition:enter="transition ease duration-300 transform"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease duration-300 transform"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                <span class="absolute top-0 left-0 w-3 h-3 bg-white border transform rotate-45 -mt-1 ml-6"></span>
                                <div class="bg-white rounded w-full relative z-10 py-1">
                                    <ul class="list-reset">
                                        <li class="relative" x-data="{showChildren:false}" @mouseleave="showChildren=false"
                                            @mouseenter="showChildren=true">
                                            <a href="#"
                                                class="px-4 py-2 flex w-full items-start hover:bg-gray-100 no-underline hover:no-underline transition-colors duration-100 cursor-pointer">
                                                <span class="flex-1">¿Quienes somos?</span> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="block relative">
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300">Buscador</a>
                        </li>
                        <li class="block relative">
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300">Afiliate</a>
                        </li>
                        <li class="block relative">
                            <a href="#"
                                class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline hover:text-white transition-colors duration-100 mx-1 hover:bg-yellow-300">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="sm:hidden" id="mobile-menu" x-show="showChildren">
        <div class="px-2 pt-2 pb-3 space-y-1" x-data="{showChildren:false}" @mouseleave="showChildren=false"
        @mouseenter="showChildren=true">
            <ul>
                <li class="block relative" x-data="{showSubmenu:false}" @click.away="showSubmenu=false">
                    <a href="#" class="hover:bg-yellow-300 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl font-medium"
                        @click.prevent="showSubmenu=!showSubmenu" aria-current="page">MorelosSí
                        <span class="ml-2">
                        
                        <i x-show="!showSubmenu" class="mdi mdi-chevron-down"></i> </span>
                    
                        <i x-show="showSubmenu" class="mdi mdi-chevron-up"></i> </span>
                    </a>

                    <div class="sm:hidden" id="mobile-submenu" x-show="showSubmenu">
                        <ul class="list-reset">
                            <li class="block relative" x-data="{showSubmenu:false}" @mouseleave="showSubmenu=false" @mouseenter="showSubmenu=true>
                                <a href="#" class="hover:bg-yellow-300 hover:text-white block pl-12 px-3 py-2 rounded-md text-xl">
                                    ¿Quienes somos?
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="block relative">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl">Buscador</a>
                </li>

                <li class="block relative">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl font-medium">Afiliate</a>
                </li>

                <li class="block relative">
                    <a href="#"
                        class="hover:bg-yellow-300 hover:text-white block pl-8 px-3 py-2 rounded-md text-xl font-medium">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}


<div class="h-56 w-full sm:h-72 md:h-96 lg:w-full block mx-auto justify-center items-center bg-indigo-100">    
    <div class="mx-auto relative" x-data="{ activeSlide:1, slides:[1,2,3,4,5]}">
        <!-- Slides -->
        
        <template x-for="slide in slides" :key="slide">
            <div x-show="activeSlide === slide"
                class="h-56 w-full sm:h-72 md:h-96 lg:w-full font-bold text-5xl flex items-center bg-indigo-500 text-white rounded-lg">
                

                {{-- <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                        fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <polygon points="50,0 100,0 50,100 0,100" />
                    </svg>
                    <span class="lg:p-20 w-12 z-10 text-center"></span>
                </div> --}}
               
                {{-- <span class="text-indigo-300">/</span>
                <span class="w-12 text-center" x-text="slides.length"></span> --}}
                <span class="text-indigo-300">{{$activeSlide}}</span>
                <img class="h-56 w-full bg-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                    src="{{asset('storage/banners/banner'.$activeSlide.'.png')}}"
                    alt="">
                    {{-- src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" --}}
                    {{-- <div class="flex relative text-center">
                        <h1 class="text-3xl tracking-wider text-white text-sha uppercase font-bold p-4 self-center z-10 content-center absolute text-center w-full md:text-4xl">Welcome to Lightning deals</h1>
                        <img class="w-full object-cover h-72 block mx-auto  sm:block sm:w-full" 
                        src="https://images.unsplash.com/photo-1505934333218-8fe21ff87e69?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                         alt="Banner"  />
                        </div> --}}
            </div>
        </template>

        <!-- Prev/Next Arrows -->
        <div class="absolute inset-7 flex">
            <div class="flex items-center justify-start w-1/2">
                <button
                    class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                    &#8592;
                </button>
            </div>
            <div class="flex items-center justify-end w-1/2">
                <button
                    class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                    x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                    &#8594;
                </button>
            </div>
        </div>

        <!-- Buttons -->
        <div class="absolute w-full flex justify-center px-4">
            <template x-for="slide in slides" :key="slide">
                <button
                    class="w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-indigo-600 hover:shadow-lg"
                    :class="{ 
                'bg-yellow-600': activeSlide === slide,
                'bg-indigo-300': activeSlide !== slide 
            }" x-on:click="activeSlide = slide"></button>
            </template>
        </div>
    </div>
</div>