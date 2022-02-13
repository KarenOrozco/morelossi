<div class="">
    {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        </div>
    </div> --}}


    <div class="justify-center items-center">
        <!--actual component start-->
        <div x-data="setup()">
            <ul class="flex justify-center items-center my-4">
                <template x-for="(tab, index) in tabs" :key="index">
                    <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                        :class="activeTab===index ? 'text-rose-500 border-rose-500' : ''" @click="activeTab = index"
                        x-text="tab"></li>
                </template>
            </ul>
    
            <div wire:init="loadDashboard"  class="container mx-auto">
                {{-- <div x-show="activeTab===0"> --}}

                    @if (count($stores))
                        <div class="py-6">
                            {{-- Lista de usuarios --}}
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
                                                        <div class="flex font-semibold items-center whitespace-nowrap text-right text-sm">
                                                            {{-- <x-edit-button nameFunction="edit" item="{{$item->id}}" /> --}}
                                                            <x-show-button nameFunction="show" item="{{$item->id}}"/>
                                                            @if ($item->status == 1 || $item->status == 3)
                                                                <div class="flex">
                                                                    <x-accept-button title="Aprobar"  wire:click="$emit('acceptStore', '{{$item->id}}')">
                                                                        Aprobar
                                                                    </x-accept-button>
                                                                    <x-pending-button title="Solicitar cambios" wire:click="requestChanges({{$item->id}})" >
                                                                        Solicitar cambios
                                                                    </x-pending-button>
                                                                    {{-- wire:click="requestChanges({{$item->id}})"  --}}
                                                                    {{-- wire:click="$emit('requestChanges', '{{$item->id}}')" --}}
                                                                    <x-refuse-button title="Rechazar" wire:click="$emit('refuseStore', '{{$item->id}}')">
                                                                        Rechazar
                                                                    </x-refuse-button>
                                                                    {{-- <a href="#" class="text-green-600 hover:text-green-900">Aprobar</a>
                                                                    <a href="#" class="text-orange-600 hover:text-orange-900">Solicitar cambios</a>
                                                                    <a href="#" class="text-red-600 hover:text-red-900">Rechazar</a> --}}

                                                                </div>
                                                            @else 
                                                                @if ($item->status == 5)
                                                                    <x-pending-button title="Solicitar cambios" wire:click="requestChanges({{$item->id}})" >
                                                                        Solicitar cambios
                                                                    </x-pending-button>
                                                                    <x-refuse-button title="Rechazar" wire:click="$emit('refuseStore', '{{$item->id}}')">
                                                                        Rechazar
                                                                    </x-refuse-button>
                                                                @endif
                                                            @endif
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
                        </div>
                    @else
                        @if ($loadedData)
                            <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
                                {{-- <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div> --}}
                                <h3>Sin resultados</h3>
                            </div>
                        @else
                            <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
                                <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
                            </div>
                        @endif
                    @endif
                    
   
                {{-- </div> --}}
                
                {{-- <div x-show="activeTab===1">Content 2</div>
                <div x-show="activeTab===2">Content 3</div>
                <div x-show="activeTab===3">Content 4</div> --}}
            </div>
        </div>
        <!--actual component end-->

        {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            {{$form['title']}}
        </x-slot>

        <x-slot name="content">

            @if (!empty($store) && $open_edit === true)
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
                    <p>Email de contacto: {{$store->user->email}}</p>
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

    <x-jet-dialog-modal wire:model="open_email_modal">

        <x-slot name="title">
            {{$form['title']}}
        </x-slot>
    
        <x-slot name="content">
            
            <section class="mb-4">
                <h1>{{$storeMessage->name}}</h1>
                <div class="mt-4">
                    <p>Prioridad: {{$storeMessage->priority}}</p>
                    <p>Status: {{$storeMessage->statusDescription}}</p>
                    <p>Descripción: {{$storeMessage->description}}</p>
                </div>
            </section>

            <section class="mb-4" wire:ignore>
                <x-jet-label value="Mensaje a enviar sobre los cambios a realizar" />
                <textarea id="editorEmail"
                    wire:model="message" 
                    class="form-control w-full" 
                    rows="6" required> 
                </textarea>

                <x-jet-input-error for="message" />
            </section>
            
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
    

    @push('script')
        <script>

            ClassicEditor
                .create( document.querySelector( '#editorEmail' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', () =>{
                        @this.set('message',editor.getData());
                    })
                })
                .catch( error => {
                    console.error( error );
            } );

            function setup() {
                return {
                activeTab: @entangle('index'),
                tabs: [
                    "Afiliaciones pendientes",
                    "Afiliaciones aprobadas",
                    "Afiliaciones rechazadas",
                ]
                };
            };
            Livewire.on('refuseStore', storeId => {
                
                Swal.fire({
                    title: '¿Rechazar solicitud?',
                    text: "¡No podras revertir la acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, rechazar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('dashboard.index', 'refuse-store', storeId)

                        Swal.fire(
                            '¡Rechazado!',
                            'El negocio ha sido rechazado',
                            'success'
                        )
                    }
                })

            });

            Livewire.on('acceptStore', storeId => {
                
                Swal.fire({
                    title: '¿Aprobar la solicitud?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, aprobar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('dashboard.index', 'accept-store', storeId)

                        Swal.fire(
                            '¡Aprobado!',
                            'El negocio ha sido aprobado',
                            'success'
                        )
                    }
                })

            });

            // Livewire.on('requestChanges', storeId => {
            //     Livewire.emitTo('emails.email-store', 'open-email-modal', storeId)
            // });
        </script>
    @endpush
</div>
