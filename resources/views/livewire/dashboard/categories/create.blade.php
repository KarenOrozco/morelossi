<div>
    <x-jet-secondary-button wire:click="$set('open', 'true')">
        Crear nueva categoria
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nueva categoria
        </x-slot>
        <x-slot name="content">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="mb-4">
                        <x-jet-label value="Nombre de la categoria" />
                        <x-jet-input type="text" class="w-full" wire:model="name" />

                        <x-jet-input-error for="name" />
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
                    @if ($type === '2')
                        <div class="mb-4">
                            <x-jet-label value="Categoria padre" />
                            <select wire:model="categoryId" class="w-full form-control">
                                <option value="0" selected>SELECCIONE</option>
                                @if (count($categories) !== 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                                <select>
                                    <x-jet-input-error for="categoryId" />
                        </div>
                    @endif
                </div>
            </div>

            {{-- <form action="/file-upload"
            class="dropzone"
            id="my-awesome-dropzone"></form> --}}


        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Crear categoria
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
