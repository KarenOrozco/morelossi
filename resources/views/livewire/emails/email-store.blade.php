<div>
<x-jet-dialog-modal wire:model="open_email_modal">

    <x-slot name="title">
        {{$form['title']}}
    </x-slot>

    <x-slot name="content">
        @if (!empty($storeMessage))
            <section class="mb-4">
                <h1>{{$storeMessage->name}}</h1>
                <div class="mt-4">
                    <p>Prioridad: {{$storeMessage->priority}}</p>
                    <p>Status: {{$storeMessage->status}}</p>
                    <p>Descripción: {{$storeMessage->description}}</p>
                </div>
            </section>

            <section class="mb-4">
                <x-jet-label value="Mensaje a enviar sobre los cambios a realizar" />
                <textarea 
                    x-data 
                    x-init="ClassicEditor
                    .create($refs.miEditor)
                    .catch( error => {
                        console.error( error );
                    } );" 
                    x-ref="miEditor" 
                    wire:model.defer="message" class="form-control w-full" rows="6" required> </textarea>

                <x-jet-input-error for="message" />
            </section>
        @endif
    </x-slot>
    
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('open_email_modal', false)">
            Cancel
        </x-jet-secondary-button>

        <x-jet-danger-button wire:click="{{$form['action']}}" wire:loading.attr="disabled" wire:target="{{$form['action']}}">
            {{$form['actionButton']}}
        </x-jet-danger-button>
    </x-slot>

</x-jet-dialog-modal>

</div>
