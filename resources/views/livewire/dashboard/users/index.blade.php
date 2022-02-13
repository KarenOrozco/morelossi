<div class="container">
    
    {{-- Lista de usuarios --}}
    <div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
        <h1 class="text-3xl">USUARIOS</h1>
        <x-jet-secondary-button wire:click="create()">
            Nuevo usuario
        </x-jet-secondary-button>
    </div>

    <div class="mb-4 md:flex justify-between items-center">
        <div class="flex items-center">
            <span>Mostrar</span>
            <select class="mx-2" wire:model="show">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>entradas</span>
        </div>
        <div class="flex-1 mt-4 md:mt-0 md:mx-4">
            <div class="relative lg:w-1/2">
                <x-jet-input class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" 
                    type="text" wire:model="search" placeholder="Ingresa tu busqueda" />
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7" />
                        <line x1="21" y1="21" x2="15" y2="15" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto rounded-lg shadow">

        @if (count($users))
            <table class="table-auto text-gray-600 bg-white">
                <thead class="border-b border-gray-300 bg-pink-500 text-white uppercase text-xs font-bold">
                    <tr class="text-left">
                        {{-- <th class="py-2 w-full
                        sticky top-0 border-b tracking-wider text-center
                        ">Nombre</th> --}}
                        <th class="py-2 px-6
                        sticky top-0 border-b tracking-wider text-left
                        ">Nombre</th>
                        <th class="py-2 px-6 w-full
                        sticky top-0 border-b tracking-wider text-left
                        ">Email</th>
                        <th class="py-2 px-6
                        sticky top-0 border-b tracking-wider text-left
                        ">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($users as $item)
                        <tr>
                            <td class="px-6 py-2 border-dashed border-t border-gray-200 mx-auto">
                                {{-- <a href="{{route('dashboard.users.show', $item)}}" class="uppercase"> --}}
                                    {{$item->name}}
                                {{-- </a> --}}
                            </td>
                            <td class="px-6 py-2 border-dashed border-t border-gray-200 mx-auto">
                                {{$item->email}}
                            </td>
                            <td class="px-6 py-2 text-center">
                                <div class="flex font-semibold">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="edit({{$item->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <x-delete-button nameFunction="deleteUser" item="{{$item->id}}" />
                                </div>
                            </td>
                        </tr>
                    @endforeach        
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="px-6 py-3 bg-pink-100">
                    {{ $users->links() }}
                </div>
            @endif
        @else
            <div class="py-2 mx-auto text-center bg-pink-100">
                <p>No se encontraron usuarios</p>
            </div>
        @endif

        {{$password}}
       
    </div>
       


    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            {{$form['title']}}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <div class="mb-4">
                        <x-jet-label value="Nombre" />
                        <x-jet-input type="text" class="w-full" wire:model="user.name" />

                        <x-jet-input-error for="user.name" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-label value="email" />
                    <x-jet-input type="email" wire:model="user.email" class="w-full" />

                    <x-jet-input-error for="user.email" />
                </div>

                <div class="mb-4">
                    <x-jet-label value="roles" />

                    <select wire:model.defer="rol" class="w-full">
                        <option value="0">Seleccione</option>
                        @if (count($roles)!==0)
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        @endif
                    <select>
                    <x-jet-input-error for="rol" />
                </div>
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

    </x-jet-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deleteUser', userId => {
            
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podras revertir la acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('dashboard.users.index', 'delete-user', userId)

                        Swal.fire(
                            '¡Eliminado!',
                            'El usuario ha sido eliminada',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>
