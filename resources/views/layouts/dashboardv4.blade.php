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

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <body class="bg-gray-100 font-family-karla flex">

        <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
            <div class="p-6">
                <a href="{{route('dashboard.index')}}">
                    <img class="m-auto" src="{{ asset('storage/logotipo/morelossi.png') }}">
                </a>
                {{-- <a href="index.html" class="text-white text-3xl font-semibold hover:text-gray-300">MorelosSí</a> --}}
                {{-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i> New Report
                </button> --}}
            </div>
            <nav class="text-white text-base font-semibold pt-3">
                <a href="{{route('dashboard.index')}}" class="flex items-center text-white py-4 pl-6 nav-item  {{ request()->routeIs('dashboard.index') ? 'active-nav-link' : 'opacity-75'}}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{route('dashboard.users.index')}}" class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item {{ request()->routeIs('dashboard.users.index') ? 'active-nav-link' : 'opacity-75'}}">
                    <i class="fas fa-users mr-3"></i>
                    Usuarios
                </a>
                <a href="{{route('dashboard.stores.index')}}" class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item {{ request()->routeIs('dashboard.stores.index') ? 'active-nav-link' : 'opacity-75'}}">
                    <i class="fas fa-table mr-3"></i>
                    Negocios
                </a>
                <a href="{{route('dashboard.categories.index')}}" class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item {{ request()->routeIs('dashboard.categories.index') ? 'active-nav-link' : 'opacity-75'}}">
                    <i class="fas fa-layer-group mr-3"></i>
                    Categorias
                </a>
            </nav>
        </aside>
    
        <div class="w-full flex flex-col h-screen overflow-y-hidden">
            <!-- Desktop Header -->
            <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
                <div class="w-1/2 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $header }}
                    {{-- Dashboard del administrador --}}
                </div>
                <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                    <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                        <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
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
    
            <!-- Mobile Header & Nav -->
            <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
                <div class="flex items-center justify-between">
                    <a href="index.html" class="text-white text-3xl font-semibold hover:text-gray-300">MorelosSí</a>
                    <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                        <i x-show="!isOpen" class="fas fa-bars"></i>
                        <i x-show="isOpen" class="fas fa-times"></i>
                    </button>
                </div>
    
                <!-- Dropdown Nav -->
                <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                    <a href="index.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{route('dashboard.users.index')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-users mr-3"></i>
                        Usuarios
                    </a>
                    <a href="{{route('dashboard.stores.index')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-table mr-3"></i>
                        Negocios
                    </a>
                    <a href="{{route('dashboard.categories.index')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-layer-group mr-3"></i>
                        Categorias
                    </a>

                    <a href="{{route('profile.show')}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-user mr-3"></i>
                        Mi perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Cerrar sesión
                        </a>
                    </form>
                    
                </nav>
                <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i> New Report
                </button> -->
            </header>
        
            <div class="w-full overflow-x-hidden border-t flex flex-col">
                <main class="w-full flex-grow p-6">
                    {{ $slot }}
                </main>
        
                <footer class="w-full bg-white text-right p-4">
                    MorelosSí
                </footer>
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
        @stack('script')
        <script>
            Livewire.on('alert',function($message){
                Swal.fire(
                '¡Buen trabajo!',
                $message,
                'success'
                )
            });
        </script>
    </body>
</html>
