<div>
    <x-slot name="title">
        {{$form['title']}}
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <div class="mb-4">
                    <x-jet-label value="Nombre" />
                    <x-jet-input type="text" class="w-full" wire:model="store.name" />

                    <x-jet-input-error for="store.name" />
                </div>
            </div>

            <div class="mb-4">
                <x-jet-label value="Slug" />
                <x-jet-input type="text" disabled wire:model="store.slug" class="w-full bg-gray-200"
                    placeholder="Slug" />

                <x-jet-input-error for="store.slug" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <div class="mb-4">

                    <x-jet-label value="email de contacto" />
                    <x-jet-input type="email" wire:model="user.email" class="w-full" />

                    <x-jet-input-error for="user.email" />

                    
                    {{-- <p class="clasificacion">
                        <input id="radio1" type="radio" name="estrellas" value="5"><label for="radio1">★</label>
                        <input id="radio2" type="radio" name="estrellas" value="4"><label for="radio2">★</label>
                        <input id="radio3" type="radio" name="estrellas" value="3"><label for="radio3">★</label>
                        <input id="radio4" type="radio" name="estrellas" value="2"><label for="radio4">★</label>
                        <input id="radio5" type="radio" name="estrellas" value="1"><label for="radio5">★</label>
                    </p>                         --}}


                </div>
            </div>

            <div class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="col-span-1">
                        <x-jet-label value="Prioridad" />
                        <select class="w-full" wire:model="store.priority">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        
                        <x-jet-input-error for="store.priority" />
                    </div>

                    <div class="col-span-1">
                        <x-jet-label value="Status" />
                        <select class="w-full" wire:model="store.status">
                            <option value="1">Pendiente</option>
                            <option value="2">Cambio en revisión</option>
                            <option value="3">Aprobado</option>
                            <option value="4">Rechazado</option>
                        </select>

                        <x-jet-input-error for="store.status" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <x-jet-label value="Descripción" />
            <textarea class="form-control w-full" wire:model="store.description" rows="5"> </textarea>

            <x-jet-input-error for="store.description" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('open_edit', false)">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button wire:click="{{$form['action']}}" wire:loading.attr="disabled" wire:target="{{$form['action']}}">
            {{$form['actionButton']}}
        </x-jet-danger-button>
    </x-slot>

</div>