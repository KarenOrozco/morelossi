<div>
    {{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="$set('open', 'true')">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
    </div> --}}

    {{-- <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar categoria
        </x-slot>
        <x-slot name="content"> --}}


            <div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
                <h1 class="text-3xl">{{ $form['title'] }}</h1>
        
                <div>
                    <x-secondary-button href="{{route('dashboard.categories.index')}}">
                        Ir a listado de categorias
                    </x-secondary-button>
        
                    <x-jet-danger-button wire:click="{{ $form['action'] }}" wire:loading.attr="disabled"
                        wire:target="{{ $form['action'] }}">
                        {{ $form['actionButton'] }}
                    </x-jet-danger-button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="mb-4">
                        <x-jet-label value="Nombre de la categoria" />
                        <x-jet-input type="text" class="w-full" wire:model="category.name" />

                        <x-jet-input-error for="category.name" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Slug" />
                    <x-jet-input type="text" disabled wire:model="slug" class="w-full bg-gray-200"
                        placeholder="Slug del producto" />

                    <x-jet-input-error for="slug" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="mb-4">
                        <x-jet-label value="Tipo" />

                        <div class="space-x-4">
                            <x-jet-input wire:model="type" value="1" type="radio" />Categoria
                            <x-jet-input wire:model="type" value="2" type="radio" />Subcategoria
                        </div>

                        <x-jet-input-error for="type" />
                    </div>
                </div>

                <div class="col-span-1">
                    @if ($type === '2' )
                        <div class="mb-4">
                            <x-jet-label value="Categoria padre" />
                                <select wire:model="categoryId" class="w-full form-control">
                                    <option value="0">SELECCIONE</option>
                                    @if (count($categories) !== 0)
                                        @foreach ($categories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }} </option>
                                        @endforeach
                                    @endif
                                <select>
                            <x-jet-input-error for="categoryId" />
                        </div>
                    @endif
                </div>
            </div>

            <section>
                <h2>IMAGENES</h2>

                <div class="mb-4" wire:ignore>
                    <form action="{{ route('dashboard.categories.files', $category) }}" method="POST" class="dropzone"
                        id="dropzone-banners-categories"></form>
                </div>

                @if (count($category->images))
                    <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                        <h1 class="text-2xl text-center font-semibold mb-1">Banners de la categoria</h1>
                        <p class="text-center mb-2">Máximo 5 imagenes</p>
                        <ul class="flex flex-wrap">
                            @foreach ($category->images as $image)
                                <li class="relative" wire:key="banner-{{$image->id}}">
                                    <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}">
                                    <x-jet-danger-button class="absolute right-2 top-2" wire:click="deleteBanner({{$image->id}})"
                                        wire:loading.attr="disabled"
                                        wire:target="deleteBanner({{$image->id}})">
                                        x
                                    </x-jet-danger-button>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif
            </section>

        {{-- </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                class="disabled:opacity-25">
                Actualizar categoria
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal> --}}

    @push('script')
        <script>
            Dropzone.options.dropzoneBannersCategories = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                maxFiles: 5,
                complete: function(file){
                    this.removeFile(file);
                },
                queuecomplete: function(){
                    Livewire.emit('refreshCategory');
                }
            };
        </script>
    @endpush
</div>
