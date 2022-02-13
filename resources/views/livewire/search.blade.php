<div class="flex-1 relative z-10" x-data>
    
    <form action="{{ route('search') }}" autocomplete="off">

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="col-span-1">
                <x-jet-label class="" value="Categoria" />
                <select name="category" wire:model="category" class="w-full">
                    <option value="all" selected>TODAS</option>
                    @if (count($categories)!==0)
                        @foreach ($categories as $item)
                            <option value="{{ $item->slug }}">{{ $item->name }}</option>
                        @endforeach
                    @endif
                    <select>
                <x-jet-input-error for="category" />
            </div>

            <div>
                <x-jet-label class="w-full" value="Ciudad/Municipio" />
                <select name="city" wire:model="city" class="w-full">
                    <option value="all" selected>TODOS</option>
                    @if (count($cities)!==0)
                        @foreach ($cities as $item)
                            <option value="{{ $item->slug }}">{{ $item->name }}</option>
                        @endforeach
                    @endif
                    <select>
                <x-jet-input-error for="city" />
            </div>
        </div>

        <div class="flex relative">
            <x-jet-input name="search" wire:model="search" type="text" class="w-full" placeholder="¿Estás buscando algún lugar?" />

            <button class="absolute top-0 right-0 w-12 h-full bottom-5 bg-pink-500 flex items-center justify-center rounded-r-md">
                <x-search size="35" color="white" />
            </button>
        </div>

    </form>

    <div class="absolute w-full mt-1 hidden" :class="{ 'hidden' : !$wire.open }" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-4  py-3 space-y-1">
                @forelse ($stores as $store)
                    <a href="{{ route('companies.show', [$store->categories->first()->parent ,$store]) }}" class="flex">
                        <img class="w-16 h-12 object-cover" src="{{ Storage::url($store->images->first()->url) }}" alt="">
                        <div class="ml-4 text-gray-700">
                            <p class="text-lg font-semibold leading-5">{{$store->name}}</p>
                            <p>
                                Categorias: 
                                @foreach ($store->categories as $category)
                                    {{$category->name}}
                                    @if ($loop->last)
                                    @else
                                    ,
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="text-lg leading-5">
                        No existe ningún registro con los parametros especificados
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
