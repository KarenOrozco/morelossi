<div>
    @if ($store)
        <div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
            <h1 class="text-3xl">{{ $form['title'] }}</h1>

            <div>
                <x-jet-secondary-button wire:click="$set('open_edit', false)">
                    Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="{{ $form['action'] }}" wire:loading.attr="disabled"
                    wire:target="{{ $form['action'] }}">
                    {{ $form['actionButton'] }}
                </x-jet-danger-button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="col-span-1">

                <section>
                    <h2>LOGOTIPO</h2>

                        <div class="mb-4">
                            @if ($store->user->image)
                                <section>
                                    <ul class="flex flex-wrap">
                                        <li class="relative" wire:key="logo-{{$store->user->image->id}}">
                                            <img class="m-auto w-32 h-20 object-cover" src="{{ Storage::url($store->user->image->url) }}">

                                            <x-jet-danger-button class="absolute right-2 top-2" wire:click="deleteLogo({{$store->user->image->id}})"
                                                wire:loading.attr="disabled"
                                                wire:target="deleteLogo({{$store->user->image->id}})">
                                                x
                                            </x-jet-danger-button>
                                        </li>
                                    </ul>
                                </section>
                            @else 
                            <section>
                                <ul class="flex flex-wrap">
                                    <li class="relative">
                                        <img class="m-auto w-32 h-20 object-cover" src="https://images.pexels.com/photos/273214/pexels-photo-273214.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                                    </li>
                                </ul>
                            </section>
                            @endif
                        </div>

                        <div class="mb-4" wire:ignore>
                            <form action="{{ route('dashboard.users.logo', $store->user) }}" method="POST" class="dropzone"
                                id="logo-dropzone"></form>
                        </div>
                        
                </section>

                <section>
                    <h2>DATOS</h2>

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

                   
                    <div class="mb-4">

                        <x-jet-label value="email de contacto" />
                        <x-jet-input type="email" wire:model="user.email" class="w-full" />

                        <x-jet-input-error for="user.email" />
                    </div>
                      


                    <div class="mb-4">
                        <x-jet-label value="Descripción" />
                        <textarea class="form-control w-full" wire:model="store.description" rows="5"> </textarea>

                        <x-jet-input-error for="store.description" />
                    </div>
                </section>

                <section>
                    <h2>IMAGENES</h2>

                    <div class="mb-4" wire:ignore>
                        <form action="{{ route('dashboard.stores.files', $store) }}" method="POST" class="dropzone"
                            id="my-awesome-dropzone"></form>
                    </div>

                    @if ($store->images->count())
                        <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                            <h1 class="text-2xl text-center font-semibold mb-1">Imagenes del negocio</h1>
                            <p class="text-center mb-2">Máximo 5 imagenes</p>
                            <ul class="flex flex-wrap">
                                @foreach ($store->images as $image)
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
            </div>

            <div>

                <section>
                    <h2>DIRECCIONES</h2>

                    <div class="mb-4 grid grid-cols-2 space-x-4">
                        <div class="col-span-1">
                            <x-jet-label value="Ciudad/Municipio" />

                            <select wire:model="cityId" class="w-full">
                                <option value="0" selected>SELECCIONE</option>
                                @if (count($cities) !== 0)
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                @endif
                                <select>

                                    <x-jet-input-error for="cityId" />
                        </div>

                        <div>
                            <x-jet-label value="Colonia" />
                            <select wire:model="localityId" class="w-full">
                                @if (count($localities) !== 0)
                                    @foreach ($localities as $locality)
                                        <option value="{{ $locality->id }}">{{ $locality->name }}</option>
                                    @endforeach
                                @endif
                                <select>
                                    <x-jet-input-error for="localityId" />
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-4 space-x-4">
                        <div class="col-span-2">
                            <x-jet-label value="Calle" />
                            <x-jet-input wire:model.defer="street" type="text" class="w-full" />

                            <x-jet-input-error for="street" />
                        </div>

                        <div>
                            <x-jet-label value="Número" />
                            <x-jet-input wire:model.defer="number" min="1" type="number" class="w-full" />

                            <x-jet-input-error for="number" />
                        </div>

                        <div>
                            <x-jet-label value="Código Postal" />
                            <x-jet-input wire:model.defer="postalcode" min="10000" max="99999" type="number"
                                class="w-full" />

                            <x-jet-input-error for="postalcode" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-jet-label value="Referencia" />
                        <x-jet-input wire:model.defer="reference" type="text" class="w-full" />

                        <x-jet-input-error for="reference" />
                    </div>


                    <x-jet-secondary-button wire:click="addDirection" wire:loading.attr="disabled"
                        wire:target="addDirection" class="disabled:opacity-25 my-auto mx-auto">
                        <i class="pt-1 mdi mdi-plus mdi-24px"></i>
                        Agregar dirección
                    </x-jet-secondary-button>



                    <div class="py-4">
                        @if (count($addresses) !== 0)

                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left">Ciudad</th>
                                        <th class="py-3 px-3 xl:px-6 text-left">Localidad</th>
                                        <th class="py-3 px-6 text-center">Calle</th>
                                        <th class="py-3 px-3 text-center">#</th>
                                        <th class="py-3 px-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($addresses as $item)
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
                                            <td class="py-3 px-3 text-center">
                                                <div wire:click="deleteDirection({{ $item }})"
                                                    class="flex item-center justify-center">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
                                                </div>
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

                </section>

                <section>
                    <h2>TELEFONOS DE CONTACTO</h2>

                    <div class="mb-4">

                        <x-jet-label value="Número de telefono" />
                        <x-jet-input wire:model.defer="phoneNumber" min="1000000" max="9999999" digits="7" type="number"
                            class="w-full" />

                        <x-jet-input-error for="phoneNumber" />
                    </div>

                    <x-jet-secondary-button wire:click="addPhonenumber" wire:loading.attr="disabled"
                        wire:target="addPhonenumber" class="disabled:opacity-25 my-auto mx-auto">
                        <i class="pt-1 mdi mdi-phone-plus mdi-24px"></i>
                        Agregar telefono
                    </x-jet-secondary-button>

                    <div class="py-4">
                        @if (count($phones) !== 0)

                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left">Número de telefono</th>
                                        <th class="py-3 px-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($phones as $phone)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-3 xl:px-6 text-left">
                                                <div class="flex items-center">
                                                    <span>{{ $phone->phone_number }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-3 text-center">
                                                <div wire:click="deletePhones({{ $phone }})"
                                                    class="flex item-center justify-center">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
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
                </section>

                <section>
                    <h2>REDES SOCIALES</h2>

                    <div class="mb-4 grid grid-cols-3 space-x-4">
                        <div class="col-span-1">
                            <div class="mb-4">
                                <x-jet-label value="Red social" />
                                <select wire:model="socialNetwork" class="w-full">
                                    <option value="1" selected>FACEBOOK</option>
                                    <option value="2">INSTAGRAM</option>
                                    <option value="3">TWITTER</option>
                                    <select>

                                        <x-jet-input-error for="socialNetwork" />
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-4">
                                <x-jet-label value="URL" />
                                <x-jet-input wire:model.defer="url" type="text" class="w-full" />

                                <x-jet-input-error for="url" />
                            </div>
                        </div>
                    </div>

                    <x-jet-secondary-button wire:click="addSocialNetwork" wire:loading.attr="disabled"
                        wire:target="addSocialNetwork" class="disabled:opacity-25 my-auto mx-auto">
                        @switch($socialNetwork)
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

                        <span>Agregar red social<span>
                    </x-jet-secondary-button>

                    <div class="py-4">
                        @if (count($socialNetworks) !== 0)

                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-3 xl:px-6 text-left"></th>
                                        <th class="py-3 px-3 xl:px-6 text-left"></th>
                                        <th class="py-3 px-3 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($socialNetworks as $item)
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
                                            <td class="py-3 px-3 text-center">
                                                <div wire:click="deleteSocialNetwork({{ $item }})"
                                                    class="flex item-center justify-center">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
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
                </section>

                <section>
                    <h2>HORARIO</h2>

                    <div class="mb-4 grid grid-cols-3 space-x-4">
                        <div class="col-span-1">
                            <div class="mb-4">
                                <x-jet-label value="Días de trabajo" />

                                @foreach ($days as $key => $day)
                                    <div>
                                        <x-jet-checkbox wire:model="workDays.{{ $key }}"
                                            value="{{ $key }}" />
                                        <label class="font-medium text-sm text-gray-700">{{ $day }}</label>
                                    </div>
                                @endforeach

                                <x-jet-input-error for="workDays" />
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="mb-4">
                                <x-jet-label value="Hora de apertura" />
                                <x-jet-input wire:model="startTime" min="1" max="24" type="time" class="form-control" />
                                <x-jet-input-error for="startTime" />
                            </div>
                            <div class="mb-4">
                                <x-jet-label value="Hora de cierre" />
                                <x-jet-input wire:model="finishTime" min="1" max="24" type="time" placeholder="07"
                                    class="" />
                                <x-jet-input-error for="finishTime" />
                            </div>
                        </div>
                    </div>


                    <x-jet-secondary-button wire:click="addWorkShedule" wire:loading.attr="disabled"
                        wire:target="addWorkShedule" class="disabled:opacity-25 my-auto mx-auto">
                        <i class="pt-1 mdi mdi-clock mdi-24px"></i>
                        Agregar horario
                    </x-jet-secondary-button>

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

                                                        <div wire:click="deleteSchedule( {{ $key }}, {{ $i }}, {{ $schedule['id'] }} )"
                                                            class="mb-1">
                                                            <div
                                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </div>
                                                        </div>
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
            </div>
        </div>

    @else
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <h3>Sin resultados</h3>
        </div>
    @endif

    
    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
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
                    Livewire.emit('refreshStore');
                }
            };

            Dropzone.options.logoDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Clic para subir una imagen o arrastre a este espacio",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                maxFiles: 1,
                complete: function(file){
                    this.removeFile(file);
                },
                queuecomplete: function(){
                    Livewire.emit('refreshUser');
                }
            };
        </script>

    @endpush
</div>
