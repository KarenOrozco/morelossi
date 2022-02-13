<div class="">     

    <x-slideshow-3 :banners="$banners" :title="$category->name" />

    <div class="container">
    <div class="bg-white rounded-lg shadow-lg my-4">
        <div class="px-6 py2 justify-between">
            @if ($category !== null)
                <h2 class="py-4 uppercase text-center">{{ $category->name }}</h2>
            @endif

            <div class="w-full md:w-1/2 mx-auto pb-6">
                @if ($city)
                    @livewire('search', ['category' => $category->slug, 'city' => $city->slug,'search' => $search])
                @else
                    @livewire('search', ['category' => $category->slug, 'search' => $search])
                @endif
            </div>
        </div>
        {{-- <div class="flex">
            <select name="category" wire:model="category.slug" class="">
                <option value="all" >SELECCIONE</option>
                @if (count($rootCategories)!==0)
                    @foreach ($rootCategories as $item)
                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                    @endforeach
                @endif
                <select>
            <x-jet-input-error for="category.slug" />

            <select name="city" wire:model="city" class="">
                <option value="all" >SELECCIONE</option>
                @if (count($cities)!==0)
                    @foreach ($cities as $item)
                        <option value="{{ $item->slug }}">{{ $item->name }}</option>
                    @endforeach
                @endif
                <select>
            <x-jet-input-error for="city" />
            
            <x-jet-input name="search" wire:model="search" type="text" class="w-full" placeholder="¿Estás buscando algún lugar?" />

            <button class="absolute top-0 right-0 w-12 bottom-5 bg-pink-500 flex items-center justify-center rounded-r-md">
                <x-search size="35" color="white" />
            </button>
        </div> --}}
    </div>
    
    <div class="grid grid-cols-5 gap-6 py-6">
        <aside>
            <h3 class="font-semibold text-center mb-2">Subcategorias<h3>
            <ul class="divide-y divide-pink-200">

                <x-list-subcategories :category="$category" :categoriaHija="$categoriaHija"/>
                {{-- @foreach($category->categories as $subcategory)
                    <li class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-pink-500 capitalize {{ $categoriaHija == $subcategory->name ? 'text-pink-500 font-semibold' : ''}}"
                            wire:click="$set('categoriaHija', '{{$subcategory->name}}')" >
                            {{$subcategory->name}}
                        </a>
                    </li>
                @endforeach --}}
            <ul>
            <x-jet-button class="mt-4" wire:click="clean">
                Eliminar filtros
            </x-jet-button>
        </aside>

        <div class="col-span-4">
     
            <ul class="grid grid-cols-4 gap-4">
                @foreach ($storesWithPagination as $store)

                    <li class="bg-white rounded-lg shadow">
                        <article>
                            <figure>
                                <img class="h-48 w-full object-cover object-center rounded-t-lg" src="{{ Storage::url($store->images->first()->url) }}" alt="">
                            </figure>
                
                            <div class="py-4 px-6">
                                <h2>
                                    <a href="{{route('companies.show',[$store->categories->first()->parent,$store])}}">
                                        {{$store->name}}
                                    </a>
                                </h2>
                
                                <p>
                                    {{Str::limit($store->description,20)}}
                                </p>
                            </div>
                
                        </article>
                    </li>
                @endforeach
            </ul>
            <div class="my-4">
                {{$storesWithPagination->links()}}
            </div>
        </div>
    </div>

    {{-- <div class="container py-12">
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
                                        <a href="{{ route('categories.show', $categoryChild) }}"
                                            class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $categoryChild->name }}</a>
                                    @else
                                        <a href="{{ route('categories.companies', $categoryChild) }}"
                                            class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $categoryChild->name }}</a>
                                    @endif
                                @endforeach
                            </div>

                            <h1 class="text-white">
                                @if (count($category->categories) !== 0)
                                    <a href="{{ route('categories.show', $category) }}">
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
    </div> --}}
    </div>
</div>
