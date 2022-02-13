<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @livewireStyles
        @yield('css')
        @stack('css')
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
    </head>

    <body class="bg-rose-50 font-family-karla flex flex-col">

        
        <div class="flex flex-no-wrap">
            <!-- Sidebar starts -->

            {{-- sidebar menu pantalla full --}}
            <div class="">
            <div class="w-64 relative bg-gray-800 shadow h-screen flex-col justify-between hidden sm:flex  overflow-y-auto ">
                <div class="">
                    <div class="h-24 w-full flex items-center">
                        <a href="{{route('dashboard.index')}}">
                            <img class="m-auto" src="{{ asset('storage/logotipo/morelossi.png') }}">
                        </a>
                    </div>
                    <ul class="mt-12">
                        <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                            @can('dashboard.index')
                                <a href="{{route('dashboard.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                                    </svg>
                                    <span class="text-sm ml-2">Dashboard</span>
                                </a>
                            @endcan
                            {{-- <div class="py-1 px-3 bg-gray-600 rounded text-gray-300 flex items-center justify-center text-xs">5</div> --}}
                        </li>
                        
                        <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.stores.showMyStore') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                            @can('dashboard.stores.showMyStore')
                                <a href="{{route('dashboard.stores.showMyStore')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                    <i class="fas fa-table mr-4"></i>
                                    <span class="text-sm ml-2">Mi negocio</span>
                                </a>
                            @endcan
                        </li>

                        <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.stores.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                            @can('dashboard.stores.index')
                                <a href="{{route('dashboard.stores.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                    <i class="fas fa-table mr-4"></i>
                                    <span class="text-sm ml-2">Negocios</span>
                                </a>
                            @endcan
                        </li>
                        <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.categories.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                            @can('dashboard.categories.index')
                                <a href="{{route('dashboard.categories.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none" >
                                    <i class="fas fa-layer-group mr-3"></i>
                                    <span class="text-sm ml-2">Categorias</span>
                                </a>
                            @endcan
                        </li>
                        <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.events.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                            @can('dashboard.events.index')
                                <a href="{{route('dashboard.events.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none" >
                                    <i class="fas fa-calendar mr-4"></i>
                                    <span class="text-sm ml-2">Eventos</span>
                                </a>
                            @endcan
                        </li>
                        <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.users.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                            @can('dashboard.users.index')
                                <a href="{{route('dashboard.users.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                    <i class="fas fa-users mr-2"></i>
                                    <span class="text-sm ml-2">Usuarios</span>
                                </a>
                            @endcan
                        </li>
                    </ul>
                </div>
                <div class="px-8 border-t border-gray-700">
                    {{-- <ul class="w-full flex items-center justify-between bg-gray-800">
                        <li class="cursor-pointer text-white pt-5 pb-3">
                            <button aria-label="show notifications" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                    <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                </svg>
                            </button>
                        </li>
                        <li class="cursor-pointer text-white pt-5 pb-3">
                            <button aria-label="open chats" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-messages" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10"></path>
                                    <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path>
                                </svg>
                            </button>
                        </li>
                        <li class="cursor-pointer text-white pt-5 pb-3">
                            <button aria-label="open settings" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </li>
                        <li class="cursor-pointer text-white pt-5 pb-3">
                            <button aria-label="open logs" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-archive" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                    <rect x="3" y="4" width="18" height="4" rx="2"></rect>
                                    <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                    <line x1="10" y1="12" x2="14" y2="12"></line>
                                </svg>
                            </button>
                        </li>
                    </ul> --}}
                </div>
            </div>
            </div>


            {{-- sidebar menu mobile --}}
            <div class="w-64 z-40 fixed bg-gray-800 shadow h-full flex-col space-y-16 justify-between sm:hidden transition duration-150 ease-in-out" id="mobile-nav">
                <button aria-label="toggle sidebar" id="openSideBar" class="h-10 w-10 bg-gray-800 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 rounded focus:ring-gray-800" onclick="sidebarHandler(true)">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path d="M20 5V2H0v3h20zm0 6V8H0v3h20zm0 6v-3H0v3h20z" fill="white"/></svg>
                </button>
                <button aria-label="Close sidebar" id="closeSideBar" class="hidden h-10 w-10 bg-gray-800 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer text-white" onclick="sidebarHandler(false)">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
                <div class="px-6">
                    <div class="w-full flex items-center">
                        <a href="{{route('dashboard.index')}}">
                            <img class="m-auto" src="{{ asset('storage/logotipo/morelossi.png') }}">
                        </a>
                    </div>
                </div>
                <div class="overflow-y-auto h-full" id="menu-mobile">
                    <div class="">
                        <ul>
                            @can('dashboard.index')
                                <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                                    <a href="{{route('dashboard.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                                            <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                                            <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                                            <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                                        </svg>
                                        <span class=" text-sm ml-2">Dashboard</span>
                                    </a>
                                </li>
                            @endcan
                            
                            @can('dashboard.stores.showMyStore')
                                <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.stores.showMyStore') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                                    <a href="{{route('dashboard.stores.showMyStore')}}" class="flex w-full px-6 py-2 items-center focus:outline-none" >
                                        <i class="fas fa-table mr-3"></i>
                                        <span class="text-sm ml-2">Mi negocio</span>
                                    </a>
                                </li>
                            @endcan

                            @can('dashboard.stores.index')
                                <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.stores.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                                    <a href="{{route('dashboard.stores.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none" >
                                        <i class="fas fa-table mr-3"></i>
                                        <span class="text-sm ml-2">Negocios</span>
                                    </a>
                                </li>
                            @endcan

                            @can('dashboard.categories.index')
                                <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.categories.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                                    <a href="{{route('dashboard.categories.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                        <i class="fas fa-layer-group mr-3"></i>
                                        <span class="text-sm ml-2">Categorias</span>
                                    </a>
                                </li>
                            @endcan

                            @can('dashboard.events.index')
                                <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.events.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                                    <a href="{{route('dashboard.events.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                        <i class="fas fa-calendar mr-3"></i>
                                        <span class="text-sm ml-2">Eventos</span>
                                    </a>
                                </li>
                            @endcan

                            @can('dashboard.users.index')
                                <li class="font-bold flex w-full justify-between hover:text-gray-300 hover:bg-gray-600 hover:bg-opacity-25 cursor-pointer items-center mb-4 {{ request()->routeIs('dashboard.users.index') ? 'border-l-4 border-rose-500 text-white bg-gray-600 bg-opacity-25 ' : 'text-gray-400'}}">
                                    <a href="{{route('dashboard.users.index')}}" class="flex w-full px-6 py-2 items-center focus:outline-none">
                                        <i class="fas fa-users mr-2"></i>
                                        <span class="text-sm ml-2">Usuarios</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                    <div class="px-8 border-t border-gray-700">
                        <ul class="w-full flex items-center justify-between bg-gray-800">
                            <li class="cursor-pointer text-white pt-5 pb-3">
                                <button aria-label="show notifications" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                    <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                    </svg>
                                </button>
                            </li>
                            <li class="cursor-pointer text-white pt-5 pb-3">
                                <button aria-label="open settings" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                    <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </li>
                            <li class="cursor-pointer text-white pt-5 pb-3">
                                <button aria-label="open logs" class="focus:outline-none focus:ring-2 rounded focus:ring-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path d="M6 30h12a2.002 2.002 0 0 0 2-2v-3h-2v3H6V4h12v3h2V4a2.002 2.002 0 0 0-2-2H6a2.002 2.002 0 0 0-2 2v24a2.002 2.002 0 0 0 2 2z" fill="currentColor"/><path d="M20.586 20.586L24.172 17H10v-2h14.172l-3.586-3.586L22 10l6 6l-6 6l-1.414-1.414z" fill="currentColor"/></svg>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar ends -->

            <div class="w-full flex flex-col h-screen overflow-y-auto">
                <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex border-rose-500 border-b-4">
                    <div class="w-1/2 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{ $header }}
                        {{-- Dashboard del administrador --}}
                    </div>
                    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                        <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                            {{-- <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400"> --}}
                            {{-- <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-12 w-12 object-cover"> --}}
                            
                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-12 w-12 object-cover">
                            @else
                                <img class="h-10 w-10 rounded-full object-cover" src="{{Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /> 
                            @endif
                        </button>
                        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                            <a href="{{route('profile.show')}}" class="block px-4 py-2 account-link hover:text-white">Mi perfil</a>
    
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 account-link hover:text-white" onclick="event.preventDefault();
                                this.closest('form').submit();">Cerrar sesión</a>
                            </form>
                            
                        </div>
                    </div>
                </header>

                

                <div class="w-full overflow-x-hidden border-t flex-col">
                    <main class="w-full flex-grow p-6">
                        {{ $slot }}
                    </main>
                    <footer class="w-full bottom-0 bg-white text-right p-4">
                        MorelosSí
                    </footer>
                </div>
            </div>
        </div>

        <!-- AlpineJS -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
        <!-- ChartJS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
        
        @stack('modals')

        @livewireScripts
        @yield('js')
        
        <script>
            Livewire.on('alert',function($message){
                Swal.fire(
                '¡Buen trabajo!',
                $message,
                'success'
                )
            });
        </script>

        <script>
            var sideBar = document.getElementById("mobile-nav");
            var menuMobile = document.getElementById("menu-mobile");
            var openSidebar = document.getElementById("openSideBar");
            var closeSidebar = document.getElementById("closeSideBar");
            sideBar.style.transform = "translateX(-260px)";

            function sidebarHandler(flag) {
                if (flag) {
                    sideBar.style.transform = "translateX(0px)";
                    menuMobile.style.WebkitOverflowScrolling = 'touch';
                    openSidebar.classList.add("hidden");
                    closeSidebar.classList.remove("hidden");
                } else {
                    sideBar.style.transform = "translateX(-260px)";
                    closeSidebar.classList.add("hidden");
                    openSidebar.classList.remove("hidden");
                }
            }
        </script>

        @stack('script')
    </body>

</html>








