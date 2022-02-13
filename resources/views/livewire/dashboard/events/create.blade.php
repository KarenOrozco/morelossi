<div>
    <x-jet-secondary-button wire:click="$set('open', 'true')">
        Nuevo evento
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Nuevo evento
        </x-slot>
        <x-slot name="content">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="mb-4">
                        <x-jet-label value="Nombre del evento" />
                        <x-jet-input type="text" class="w-full" wire:model="event.name" />

                        <x-jet-input-error for="event.name" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Slug" />
                    <x-jet-input type="text" disabled wire:model="event.slug" class="w-full bg-gray-200"
                        placeholder="Slug del producto" />

                    <x-jet-input-error for="event.slug" />
                </div>
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripción breve" />
                <textarea wire:model.defer="event.description" class="form-control w-full" rows="6" required> </textarea>

                <x-jet-input-error for="event.description" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="mb-4">
                        <x-jet-label value="Fecha" />
                        <x-jet-input type="datetime-local" class="w-full" wire:model="event.start_time" />

                        <x-jet-input-error for="event.start_time" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Fecha" />
                    <x-jet-input type="datetime-local" class="w-full" wire:model="event.finish_time"  />

                    <x-jet-input-error for="event.finish_time" />
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">
                Crear evento
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

