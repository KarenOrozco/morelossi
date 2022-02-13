<div class="container ">
    
    {{-- Lista de usuarios --}}
    <div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
        <h1 class="text-3xl">TIENDAS / NEGOCIOS</h1>
        <x-secondary-button href="{{route('dashboard.stores.create')}}" >
            Nueva tienda
        </x-secondary-button>
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

        @if (count($stores))
            <table class="table-auto w-full text-gray-600 bg-white">
                <thead class="border-b border-gray-300 bg-pink-500 text-white uppercase text-xs font-bold">
                    <tr class="text-left">
                        <th class="py-2 px-6
                        sticky top-0 border-b tracking-wider text-left
                        ">Nombre</th>
                        <th class="py-2 px-6
                        sticky top-0 border-b tracking-wider text-left
                        ">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                            Status
                        </th>
                        <th class="py-2 px-6
                        sticky top-0 border-b tracking-wider text-left 
                        ">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($stores as $item)
                        <tr>
                            <td class="px-6 py-2 border-dashed border-t border-gray-200 mx-auto">
                                {{-- <a href="{{route('dashboard.users.show', $user)}}" class="uppercase"> --}}
                                    {{$item->name}}
                                {{-- </a> --}}
                            </td>
                            <td class="px-6 py-2 mx-auto border-dashed border-t border-gray-200">
                                {{Str::limit($item->description,100)}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($item->status)
                                    @case(1)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Pendiente (nuevo)
                                        </span>
                                        @break
                                    @case(2)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Aprobado
                                        </span>
                                        @break
                                    @case(3)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            Cambios pendientes de revisión
                                        </span>
                                        @break
                                    @case(4)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rechazado
                                        </span>
                                        @break
                                    @case(5)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Cambios requeridos en espera
                                        </span>
                                        @break
                                    @default    
                                @endswitch
                                
                            </td>
                            <td class="px-6 py-2 text-center">
                                <div class="flex font-semibold">
                                    {{-- <x-edit-button nameFunction="edit" item="{{$item->id}}" /> --}}
                                    <x-show-button nameFunction="show" item="{{$item->id}}"/>
                                    <x-edit-button route='dashboard.stores.edit' :param="$item" />
                                    <x-delete-button nameFunction="deleteStore" item="{{$item->id}}" />
                                </div>
                            </td>
                        </tr>
                    @endforeach        
                </tbody>
            </table>

            @if($stores->hasPages())
                <div class="px-6 py-3 bg-pink-100">
                    {{ $stores->links() }}
                </div>
            @endif
        @else
            <div class="py-2 mx-auto text-center bg-pink-100">
                <p>No se encontraron registros</p>
            </div>
        @endif
       
    </div>
       


    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            {{$form['title']}}
        </x-slot>

        <x-slot name="content">

            @if (!empty($store))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                </div>

                <section>
                    <ul class="flex flex-wrap">
                        <li class="relative">
                            <img class="m-auto w-1/2 md:w-1/2 object-cover" src="{{ Storage::url($store->user->image->url) }}">
                        </li>
                    </ul>
                </section>
                <section>
                    <p>Nombre: {{$store->name}}</p>
                    <p>Slug: {{$store->slug}}</p>
                    <p>Email de contacto: {{$user->email}}</p>
                    <p>Prioridad: {{$store->priority}}</p>
                    <p>Status: {{$store->status}}</p>
                    <p>Descripción: {{$store->description}}</p>
                </section>

                <section>
                    <div class="py-4">
                        @if (count($store->locations) !== 0)
    
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left">Ciudad</th>
                                        <th class="py-3 px-3 xl:px-6 text-left">Localidad</th>
                                        <th class="py-3 px-6 text-center">Calle</th>
                                        <th class="py-3 px-3 text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($store->locations as $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($item->city->parent !== null)
                                                        <span wire:model.defer="addresscity"
                                                        class="font-medium">{{ $item->city->parent->name }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 xl:px-6 text-left">
                                                <div class="flex items-center">
                                                    <span wire:model.defer="addressl">{{ $item->city->name }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <span class="font-medium">{{ $item->street }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 text-center">
                                                <span
                                                    class="text-purple-600 py-1 px-3 text-xs">{{ $item->number }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
                        @else
                            <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY DIRECCIONES
                                REGISTRADAS</p>
                        @endif
                    </div>

                    <div class="py-4">
                        @if (count($store->phones) !== 0)
    
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left">Número de telefono</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($store->phones as $phone)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-3 xl:px-6 text-left">
                                                <div class="flex items-center">
                                                    <span>{{ $phone->phone_number }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
                        @else
                            <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY TELEFONOS
                                REGISTRADOS</p>
                        @endif
                    </div>

                    <div class="py-4">
                        @if (count($store->socialNetworks) !== 0)
    
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left"></th>
                                        <th class="py-3 px-3 xl:px-6 text-left"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($store->socialNetworks as $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @switch($item->type)
                                                        @case(1)
                                                            <i class="pt-1 mdi mdi-facebook mdi-24px"></i>
                                                        @break
                                                        @case(2)
                                                            <i class="pt-1 mdi mdi-instagram mdi-24px"></i>
                                                        @break
                                                        @case(3)
                                                            <i class="pt-1 mdi mdi-twitter mdi-24px"></i>
                                                        @break
                                                        @case(4)
                                                            <i class="pt-1 mdi mdi-web mdi-24px"></i>
                                                        @break
                                                        @default
    
                                                    @endswitch
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 xl:px-6 text-left">
                                                <div class="flex items-center">
                                                    <a href="{{ $item->url }}">
                                                        <span>{{ $item->url }}</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
                        @else
                            <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY REDES SOCIALES
                                REGISTRADAS</p>
                        @endif
                    </div>

                    <div class="py-4">
                        @if (count($workSchedules) !== 0)
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left">Día</th>
                                        <th class="py-3 px-3 xl:px-6 text-left">Horario</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
    
                                    @foreach ($workSchedules as $key => $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-medium">{{ $item['dayName'] }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 xl:px-6 text-left">
                                                @foreach ($item['schedules'] as $i => $schedule)
                                                    <div class="flex items-center space-x-4">
                                                        <span>{{ $schedule['startTime'] }} -
                                                            {{ $schedule['finishTime'] }} </span>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
                        @else
                            <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY HORARIOS
                                REGISTRADOS</p>
                        @endif
                    </div>

                </section>
            @endif
            

            {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
            </div> --}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                OK
            </x-jet-secondary-button>

            {{-- <x-jet-danger-button wire:click="{{$form['action']}}" wire:loading.attr="disabled" wire:target="{{$form['action']}}">
                {{$form['actionButton']}}
            </x-jet-danger-button> --}}
        </x-slot>

    </x-jet-dialog-modal>

    @push('script')
        <script>
            Livewire.on('deleteStore', storeId => {
            
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

                        Livewire.emitTo('dashboard.stores.index', 'delete-store', storeId)

                        Swal.fire(
                            '¡Eliminado!',
                            'El negocio ha sido eliminado',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>

