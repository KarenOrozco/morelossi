<div class="">

    <x-banner title="DIRECTORIO" url="banners/banner-footer.jpg"> 
        <x-slot name="slot">
            {{-- <div class="flex space-x-4 justify-center items-center my-4">
                <div class="relative w-full md:w-1/2">
                    <x-jet-input class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" 
                        type="text" wire:model="search" placeholder="Ingresa tu busqueda" />
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </div>
                </div>
        
                <x-jet-button class="py-2 motion-safe:hover:scale-110 bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">
                    Buscar
                </x-jet-button>
            </div> --}}

            <div class="w-full md:w-1/2 mx-auto my-6">
                @if ($city)
                    @livewire('search', ['search' => $search, 'city' => $city->slug])
                @else
                    @livewire('search', ['search' => $search])
                @endif
            </div>

        </x-slot>
    </x-banner>

    
    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1>
                        {{$category->name}}
                    </h1>
                   
                    <a class="text-pink-500 hover:text-pink-400 hover:underline ml-2 font-semibold" href="{{route('categories.show', compact('category','city','search') ) }}">Ver más</a>
                </div>
                
                {{-- @livewire('category-stores', ['category' => $category, 'city' => $city]) --}}

                <livewire:category-stores :category="$category" :key="time().$category->id" :city="$city" :search="$search" />

            </section>
        @endforeach
    </div>

    @push('script')
        <script>

            Livewire.on('glider',function(id){
                var glider = new Glider(document.querySelector('.glider-'+id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive:[
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            },
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            },
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            },
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            },
                        }
                    ]
                });
            });

            Livewire.on('glider-refresh',function(id){
                //document.querySelector('.glider-'+id).refresh(true);
                //glider.refresh(true);
                //glider.destroy();

                glider = new Glider(document.querySelector('.glider-'+id));
                glider.refresh(true);

            });

        </script>
    @endpush
</div>
