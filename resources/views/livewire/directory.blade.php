<div class="container py-12">
    <div class="py-5 flex items-center">

        <div class="flex item-center">
            <select wire:model="filtroPrincipal" class="mr-2">
                <option value="0">TODO</option>
                <option value="1">CATEGORIAS</option>
                <option value="2">NEGOCIOS</option>
                <option value="3">CIUDADES</option>
            <select>
        </div>
        <x-jet-input class="w-full" type="text" wire:model="search" placeholder="Ingresa tu busqueda" />
    </div>

    {{-- @if ($category !== null)
        <h1 class="py-4">Subcategorias de: {{$category->name}}</h1>     
    @else
        <h1 class="py-4">CATEGORIAS</h1>          
    @endif --}}
    
    @if ($filtroPrincipal !== 0 ||  ($filtroPrincipal === 0 && !empty($search)) )
        {{-- CATEGORIAS HIJAS --}}
        @if (count($categories) !== 0)
            <h2>CATEGORIAS</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <article class="w-full h-80 bg-cover bg-center"
                        style="background-image: url({{ url('storage/' . $category->image->url) }})">
                        <div class="w-full h-full px-8 flex flex-col justify-center">
                            <div>
                                @foreach ($category->categories as $categoryChild)
                                    @if (count($categoryChild->categories) !== 0)
                                        <a href="{{ route('categories.index', $categoryChild) }}"
                                            class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $categoryChild->name }}</a>
                                    @else
                                        <a href="{{ route('categories.companies', $categoryChild) }}"
                                            class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $categoryChild->name }}</a>
                                    @endif
                                @endforeach
                            </div>

                            <h1 class="text-white">
                                @if (count($category->categories) !== 0)
                                    <a href="{{ route('categories.index', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                @else
                                    <a href="{{ route('categories.companies', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                @endif
                            </h1>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        @endif

        {{-- NEGOCIOS --}}
        @if (count($companies) !== 0)
            <x-grid3 title="NEGOCIOS" :elements="$companies" type="companies" />
        @endif

        {{-- CIUDADES --}}
        @if (count($cities) !== 0)
            <x-grid3 title="CIUDADES" :elements="$cities" type="cities"/>
        @endif
    @else

        {{-- CATEGORIAS PADRE --}}
        @if (count($categoriesParent) !== 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($categoriesParent as $category)
                    <article class="w-full h-80 bg-cover bg-center @if ($loop->first) md:col-span-2 @endif"
                        style="background-image: url({{ url('storage/' . $category->image->url) }})">
                        <div class="w-full h-full px-8 flex flex-col justify-center">
                            <div>
                                @foreach ($category->categories as $categoryChild)
                                    @if (count($categoryChild->categories) !== 0)
                                        <a href="{{ route('categories.index', $categoryChild) }}"
                                            class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $categoryChild->name }}</a>
                                    @else
                                        <a href="{{ route('categories.companies', $categoryChild) }}"
                                            class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $categoryChild->name }}</a>
                                    @endif
                                @endforeach
                            </div>

                            <h1 class="text-white">
                                @if (count($category->categories) !== 0)
                                    <a href="{{ route('categories.index', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                @else
                                    <a href="{{ route('categories.companies', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                @endif
                            </h1>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $categoriesParent->links() }}
            </div>
        @else
            <div>
                <p>No se encontraron negocios relacionados con esta categoria </p>
            </div>
        @endif
        @if (count($companies) === 0 && count($categories) === 0 && count($categoriesParent) === 0)
            <div>
                <p>No se encontraron negocios relacionados con la busqueda </p>
            </div>
        @endif
    @endif
</div>
