<x-app-layout>

    <livewire:slideshow />
    
    <div class="container py-12">
        
        @if ($category !== null)
            <h1 class="py-4">Negocios relacionados con la categoria: {{$category->name}}</h1>     
        @else
            <h1 class="py-4">CATEGORIAS</h1>          
        @endif

        @if (count($companies) !== 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($companies as $company) 
                    <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif"
                        style="background-image: url({{url('storage/'.$company->images[0]->url)}})">
                        <div class="w-full h-full px-8 flex flex-col justify-center">
                            <h1 class="text-white">
                                <a href="{{route('companies.show', $company)}}">
                                    {{$company->name}}
                                </a>
                            </h1>
                        </div>
                    </article>
                @endforeach 
            </div>

            <div class="mt-4">
                {{$companies->links()}}
            </div>
        @else
            <div>
                <p>No se encontraron negocios relacionados con esta categoria </p>
            </div>
        @endif
    </div>
</x-app-layout>