<x-app-layout>

    {{-- <livewire:slideshow /> --}}
    <div class="container py-8">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="col-span-2">
                {{-- <x-gallery :images="$company->images" /> --}}
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($company->images as $image)
                            <li data-thumb="{{ Storage::url($image->url) }}">
                                <img src="{{ Storage::url($image->url) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

           
            <div class="col-span-2">
                <h2 class="text-center text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-rose-500 tracking-tight mb-8">
                    {{ $company->name }}</h2>

                <div class="text-base">
                    <div class="mmt-1 text-lg text-gray-500 mb-4">
                        <p>{{ $company->description }}</p>
                    </div>

                    <div class="flex my-8">
                        @if (count($company->socialNetworks))
                            @foreach ($company->socialNetworks as $item)
                                @switch($item->type)
                                    @case(1)
                                        <a href="{{ $item->url }}" target="__blank">
                                            <i class="mdi mdi-facebook mdi-48px"></i>
                                        </a>
                                    @break
                                    @case(2)
                                        <a href="{{ $item->url }}" target="__blank">
                                            <i class="mdi mdi-instagram mdi-48px"></i>
                                        </a>
                                    @break
                                    @case(3)
                                        <a href="{{ $item->url }}" target="__blank">
                                            <i class="mdi mdi-twitter mdi-48px"></i>
                                        </a>
                                    @break
                                    @case(4)
                                        <a href="{{ $item->url }}" target="__blank">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </a>
                                    @break
                                    @default
                                @endswitch
                            @endforeach
                        @endif
                    </div>
                   
                    <ul class="divide-y divide-rose-200">
                        <li class="">
                            Teléfonos de contacto
                            <div class="">
                                @foreach ($company->phones as $phone)
                                    <div class="border-b border-gray-200 hover:bg-gray-100">
                                        <div class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{ $phone->phone_number }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <li>Horario de apertura</li>
                    </ul>
                    <div class="grid grid-cols-1">
                        <div class="py-4">
                            @if (count($company->phones) !== 0)
                                <div
                                    class="py-3 px-3 bg-rose-500 text-white uppercase text-sm text-center rounded-t-lg leading-normal">
                                    <p> Teléfonos de contacto </p>
                                </div>

                                <table class="w-full table-auto shadow rounded-b-lg">
                                    <tbody class="text-gray-600 text-sm font-light">
                                        @foreach ($company->phones as $phone)
                                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span class="font-medium">{{ $phone->phone_number }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY TELEFONOS
                                    REGISTRADOS</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <div
                            class="py-3 px-3 bg-rose-500 text-white uppercase text-sm text-center rounded-t-lg leading-normal">
                            <p> Horario de apertura </p>
                        </div>

                        @if (count($workSchedules) !== 0)
                            <table class="w-full table-auto shadow rounded-b-lg">
                                {{-- <thead class="bg-gradient-to-r from-pink-800 to-red-400 text-white uppercase text-sm leading-normal">
                                            <tr>
                                                <th class="py-3 px-3 xl:px-6 text-left">Horario de apertura</th>
                                                <th class="py-3 px-3 xl:px-6 text-left"></th>
                                            </tr>
                                        </thead> --}}
                                <tbody class="text-gray-600 text-sm font-light">

                                    @foreach ($workSchedules as $key => $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-medium">{{ $item['dayName'] }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 xl:px-6 text-left">
                                                @foreach ($item['schedules'] as $i => $schedule)
                                                    <div class="flex items-center space-x-4">
                                                        <span>{{ $schedule['startTime'] }} hrs. -
                                                            {{ $schedule['finishTime'] }} hrs.</span>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY HORARIOS
                                REGISTRADOS</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')

        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>
