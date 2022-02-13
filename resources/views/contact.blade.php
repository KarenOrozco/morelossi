<x-app-layout>

    @php
        $banners = ['banners/banner1.png','banners/banner2.png','banners/banner3.png']; 
    @endphp
    
    <x-slideshow-3 :banners="$banners" title="CONTACTO"/>

    <div class="container py-8">
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1>Comunicate con nosotros</h1>
                    <h2 class="uppercase">a través de los
                        siguientes medios</h2>
                </div>

                <div class="mt-10">
                    <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white">
                                    <!-- Heroicon name: outline/globe-alt -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Correo
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                morelossi@gmail.com
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                    <!-- Heroicon name: outline/annotation -->
                                    <a href="">
                                        <i class="mdi mdi-whatsapp mdi-24px mdi-light"></i>
                                    </a>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Whatsapp</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                777-1234567
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                    <!-- Heroicon name: outline/annotation -->
                                    <a href="">
                                        <i class="mdi mdi-facebook mdi-24px mdi-light"></i>
                                    </a>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Facebook</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                https://facebook.com/
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-pink-500 text-white">
                                    <!-- Heroicon name: outline/globe-alt -->
                                    <a href="">
                                        <i class="mdi mdi-instagram mdi-24px mdi-light"></i>
                                    </a>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Instagram
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                url de instagram
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                    <!-- Heroicon name: outline/annotation -->
                                    <a href="">
                                        <i class="mdi mdi-twitter mdi-24px mdi-light"></i>
                                    </a>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Twitter</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                url de twitter
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-gray-500 text-white">
                                    <!-- Heroicon name: outline/annotation -->
                                    <a href="">
                                        <i class="mdi mdi-link mdi-24px mdi-light"></i>
                                    </a>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Otro</p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                otro medio
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
