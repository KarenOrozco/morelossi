<x-app-layout>
    <x-slideshow-2 />
    
    <div class="container bg-blue-300">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($cities as $city)
                <article class="w-full h-80 bg-cover bg-center"
                    style="background-image: url({{ url('storage/' . $city->images[0]->url) }})">

                    <div class="w-full h-full px-8 flex flex-col justify-center">
                        <h1 class="text-white">
                            <a href="">
                                {{ $city->name }}
                            </a>
                        </h1>
                    </div>
                </article>
                
            @endforeach
        </div>
        <div class="mt-4">
            {{ $cities->links() }}
        </div>
    </div>
</x-app-layout>