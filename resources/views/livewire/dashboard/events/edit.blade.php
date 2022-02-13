<div>
   
    <div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
        <h1 class="text-3xl">{{ $form['title'] }}</h1>

        <div>
            <x-secondary-button href="{{route('dashboard.events.index')}}">
                Ir a listado de eventos
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
                <x-jet-label value="Nombre del evento" />
                <x-jet-input type="text" class="w-full" wire:model="event.name" />

                <x-jet-input-error for="event.name" />
            </div>
        </div>

        <div class="mb-4">
            <x-jet-label value="Slug" />
            <x-jet-input type="text" disabled wire:model="slug" class="w-full bg-gray-200"
                placeholder="Slug del producto" />

            <x-jet-input-error for="slug" />
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
                <x-jet-input type="datetime-local" class="w-full" wire:model="start_time" />

                <x-jet-input-error for="start_time" />
            </div>
        </div>

        <div class="mb-4">
            <x-jet-label value="Fecha" />
            <x-jet-input type="datetime-local" class="w-full" wire:model="finish_time"  />

            <x-jet-input-error for="finish_time" />
        </div>
    </div>

    <section>
        <h2>IMAGENES</h2>

        <div class="mb-4" wire:ignore>
            <form action="{{ route('dashboard.events.files', $event) }}" method="POST" class="dropzone"
                id="dropzone-banners-events"></form>
        </div>

        @if (count($event->images))
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-1">Banners del evento</h1>
                <p class="text-center mb-2">Máximo 5 imagenes</p>
                <ul class="flex flex-wrap">
                    @foreach ($event->images as $image)
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

    @push('script')
        <script>
            Dropzone.options.dropzoneBannersEvents = {
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
                    Livewire.emit('refreshEvent');
                }
            };
        </script>
    @endpush
</div>
