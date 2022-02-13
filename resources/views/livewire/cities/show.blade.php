<div>
    <div class="container py-12">

        @if ($city !== null)
            <h1 class="py-4">Municipio: {{ $city->name }}</h1>
        @endif

        {{-- CIUDADES HIJAS --}}
        @if (count($cities) !== 0)
            <h2>Colonias</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($cities as $city)
                    <article class="w-full h-80 bg-cover bg-center"
                        style="background-image: url({{ url('storage/' . $city->images->first()->url) }})">
                        <div class="w-full h-full px-8 flex flex-col justify-center">
                            
                            <h1 class="text-white">
                                {{ $city->name }}
                            </h1>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $cities->links() }}
            </div>
        @endif
    </div>
</div>
