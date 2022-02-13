<div class="container py-12 ">
    <div class="mb-8">
        <h1 class="text-center">FORMATO DIGITAL DE AFILIACIÓN</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="col-span-1">
            <div class="mb-4 space-y-4">
                @if ($logo)
                    <div wire:loading.remove wire:target="logo">
                        <img class="w-2/5 md:w-1/2" src="{{ $logo->temporaryUrl() }}">
                        <button class="text-red-500" wire:click="deleteLogo">X Eliminar logo actual</button>
                    </div>
                @else
                    <div wire:loading.remove wire:target="logo"
                        class="border border-pink-300 shadow rounded-md p-4 max-w-sm w-full">
                        <div class="block space-x-4 space-y-4">
                            <div class="rounded-full bg-pink-400 h-24 w-24 mx-auto"></div>
                            <div class="h-6 bg-pink-400 rounded mx-auto px-2 ">
                                <p class="text-white font-bold text-center">LOGOTIPO
                                <p>
                            </div>
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="logo"
                    class="border border-pink-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                    <div class="animate-pulse flex space-x-4">
                        <div class="rounded-full bg-pink-400 h-12 w-12"></div>
                        <div class="flex-1 space-y-4 py-1">
                            <div class="h-auto bg-pink-400 rounded w-3/4">
                                <p class="text-white font-bold text-center">¡Cargando imagen!
                                <p>
                            </div>
                            <div class="space-y-2">
                                <div class="h-auto bg-pink-400 rounded p-2">
                                    <p class="text-white font-semibold text-justify">Espere un momento hasta que la
                                        imagen se haya procesado.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Logotipo *" />
                    <input wire:loading.attr="disabled" wire:target="logo" wire:model.defer="logo" type="file" accept="image/png, .jpeg, .jpg" id={{ $identificador }} required />
                    <x-jet-input-error for="logo" />
                </div>
                {{-- <div wire:loading wire:target="logo"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">¡Cargando imagen!</strong>
                    <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado.</span>
                </div> --}}

            </div>

            <div class="mb-4">
                <x-jet-label value="Nombre del negocio *" />
                <x-jet-input wire:model.defer="name" type="text" class="w-full" required />

                <x-jet-input-error for="name" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Email de contacto *" />
                <x-jet-input wire:model.defer="email" type="email" class="w-full" required />

                <x-jet-input-error for="email" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Descripción breve del negocio *" />
                <textarea wire:model.defer="description" class="form-control w-full" rows="6" required> </textarea>

                <x-jet-input-error for="description" />
            </div>

            <section>
                <h2>BANNERS</h2>

                {{-- <div class="mb-4" wire:ignore>
                    <form action="{{ route('companies.files') }}" method="POST" class="dropzone"
                        id="banners-dropzone"></form>
                </div> --}}

                
                

                <div class="mb-4">
                    <x-jet-label value="Banners de los productos/servicios que ofrece (MÁXIMO 5) *" />
                    <input {{count($temporaryBanners) > 4 ? 'disabled' : ''}} class="form-control"  wire:model.defer="banners" wire:loading.attr="disabled" wire:target="banners" type="file" multiple accept="image/png, .jpeg, .jpg" id="{{$identificadorBanners}}" />
                    @if (count($temporaryBanners) > 4)
                        <p>Se han subido las 5 imagenes</p>
                    @endif
                    <x-jet-input-error for="temporaryBanners" />
                    <x-jet-input-error for="banners" />
                    <x-jet-input-error for="banners.*" />

                    <div wire:loading wire:target="banners"
                        class="border border-pink-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-pink-400 h-12 w-12"></div>
                            <div class="flex-1 space-y-4 py-1">
                                <div class="h-auto bg-pink-400 rounded w-3/4">
                                    <p class="text-white font-bold text-center">¡Cargando imagenes!
                                    <p>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-auto bg-pink-400 rounded p-2">
                                        <p class="text-white font-semibold text-justify">Espere un momento hasta que las
                                            imagenes se hayan procesado.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($temporaryBanners))
                        <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                            <h1 class="text-2xl text-center font-semibold mb-1">Imagenes del negocio</h1>
                            <p class="text-center mb-2">Máximo 5 imagenes</p>
                            <ul class="flex flex-wrap">
                                @foreach ($temporaryBanners as $key => $banner)
                                    <li class="relative" wire:key="banner-{{$key}}">
                                        <img class="w-32 h-20 object-cover" src="{{ $banner->temporaryUrl() }}" >
                                        <x-jet-danger-button class="absolute right-2 top-2" wire:click="deleteBanner({{$key}})"
                                            wire:loading.attr="disabled"
                                            wire:target="deleteBanner({{$key}})">
                                            x
                                        </x-jet-danger-button>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif
                </div>
            </section>
        </div>

        <div>

            <section>
                <h2>DIRECCIONES</h2>

                <div class="mb-4 grid grid-cols-2 space-x-4">
                    <div class="col-span-1">
                        <x-jet-label value="Ciudad/Municipio" />

                        <select wire:model.defer="cityId" class="w-full">
                            <option value="0" selected>SELECCIONE</option>
                            @if (count($cities)!==0)
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            @endif
                        <select>

                        <x-jet-input-error for="cityId" />
                    </div>

                    <div>
                        <x-jet-label value="Colonia" />
                        <select wire:model.defer="localityId" class="w-full">
                            @if (count($localities)!==0)
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
                        <x-jet-input wire:model.defer="numInt" min="1" type="number" class="w-full" />

                        <x-jet-input-error for="numInt" />
                    </div>

                    <div>
                        <x-jet-label value="Código Postal" />
                        <x-jet-input wire:model.defer="postalcode" min="10000" max="99999" type="number" class="w-full" />

                        <x-jet-input-error for="postalcode" />
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Referencia" />
                    <x-jet-input wire:model.defer="reference" type="text" class="w-full" />

                    <x-jet-input-error for="refrence" />
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
                                @for ($i = 0; $i < count($addresses); $i++)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span wire:model.defer="addresscity" class="font-medium">{{ $addresses[$i]['cityId'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 xl:px-6 text-left">
                                            <div class="flex items-center">
                                                <span wire:model.defer="addressl">{{ $addresses[$i]['localityId'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <span class="font-medium">{{ $addresses[$i]['street'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <span
                                                class="text-purple-600 py-1 px-3 text-xs">{{ $addresses[$i]['numInt'] }}</span>
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <div wire:click="deleteDirection({{$i}})" class="flex item-center justify-center">
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
                                @endfor

                            </tbody>
                        </table>
                    @else
                        <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY DIRECCIONES REGISTRADAS</p>
                    @endif
                </div>

            </section>

            <section>
                <h2>TELEFONOS DE CONTACTO</h2>

                <div class="mb-4 grid grid-cols-3 space-x-4">
                    <div>
                        <x-jet-label value="Tipo de contacto" />
                        <select wire:model.defer="typePhoneNumber" class="w-full">
                            <option value="0" selected>SELECCIONE</option>
                            <option value="1" selected>Llamadas</option>
                            <option value="2" selected>WhatsApp</option>
                            <option value="3" selected>Llamadas y WhatsApp</option>
                        <select>

                        <x-jet-input-error for="typePhoneNumber" />
                    </div>
                    <div class="col-span-2">
                        <x-jet-label value="Número de telefono" />
                        <x-jet-input wire:model.defer="phoneNumber" min="1000000" max="9999999" digits="10" type="number" class="w-full" />

                        <x-jet-input-error for="phoneNumber" />
                    </div>
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
                                    <th class="py-3 px-3 xl:px-6 text-left">Tipo de contacto</th>
                                    <th class="py-3 px-3 xl:px-6 text-left">Número de telefono</th>
                                    <th class="py-3 px-3 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @for ($i = 0; $i < count($phones); $i++)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                @switch($phones[$i]['typePhoneNumber'])
                                                    @case(1)
                                                        <span class="font-medium">Llamadas</span>
                                                        @break
                                                    @case(2)
                                                        <span class="font-medium">WhatsApp</span>
                                                        @break
                                                    @case(3)
                                                        <span class="font-medium">Llamadas y WhatsApp</span>
                                                        @break
                                                    @default
                                                @endswitch
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 xl:px-6 text-left">
                                            <div class="flex items-center">
                                                <span >{{ $phones[$i]['phoneNumber'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <div wire:click="deletePhones({{$i}})" class="flex item-center justify-center">
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
                                @endfor

                            </tbody>
                        </table>
                    @else
                        <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY TELEFONOS REGISTRADOS</p>
                    @endif
                </div>
            </section>

            <section>
                <h2>REDES SOCIALES</h2>

                <div class="mb-4 grid grid-cols-3 space-x-4">
                    <div class="col-span-1">
                        <div class="mb-4">
                            <x-jet-label value="Red social" />
                            <select wire:model.defer="socialNetwork" class="w-full">
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
                                @for ($i = 0; $i < count($socialNetworks); $i++)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                @switch($socialNetworks[$i]['socialNetwork'] )
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
                                                <span >{{ $socialNetworks[$i]['url'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <div wire:click="deleteSocialNetwork({{$i}})" class="flex item-center justify-center">
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
                                @endfor

                            </tbody>
                        </table>
                    @else
                        <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY REDES SOCIALES REGISTRADAS</p>
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
                                    <x-jet-checkbox wire:model.defer="workDays.{{$key}}" value="{{$key}}"/>
                                    <label class="font-medium text-sm text-gray-700">{{$day}}</label>
                                </div>
                            @endforeach

                            <x-jet-input-error for="workDays" />
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="mb-4">
                            <x-jet-label value="Hora de apertura" />
                            <x-jet-input wire:model.defer="startTime" min="1" max="24" type="time" class="form-control" />
                            <x-jet-input-error for="startTime" />
                        </div>
                        <div class="mb-4">
                            <x-jet-label value="Hora de cierre" />
                            <x-jet-input wire:model.defer="finishTime" min="1" max="24" type="time" placeholder="07" class="" />
                            <x-jet-input-error for="finishTime"  />
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
                                
                                @foreach ($workSchedules as $key => $workSchedule)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-3 xl:px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{$workSchedule['dayName']}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 xl:px-6 text-left">
                                            @for ($i = 0; $i < count($workSchedule['schedules']); $i++)
                                                <div class="flex items-center space-x-4">
                                                    <span >{{ $workSchedule['schedules'][$i]['startTime'] }}  - {{ $workSchedule['schedules'][$i]['finishTime'] }} </span>

                                                    <div wire:click="deleteSchedule({{$key}},{{$i}})" class="mb-1">
                                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div> 
                                            @endfor
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <p class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">NO HAY HORARIOS REGISTRADOS</p>
                    @endif
                </div>
            </section>
        </div>
        <div>
            {{-- <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save, logo, addDirection"
                class="h-12 bg-pink-600 text-lg text-white font-semibold disabled:opacity-25">
                ENVIAR
            </x-jet-secondary-button> --}}

            <x-button-lg wire:click="save" wire:loading.attr="disabled" wire:target="save, logo, addDirection">
                ENVIAR
            </x-button-lg>

            <!-- <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save, logo, addDirection"
                class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500">
                ENVIAR
            </x-jet-button> -->
        </div>

        <div wire:loading wire:target="save">
            <x-loading-spinner />
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="mt-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">¡Advertencia!</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @push('script')
        <script>
            Dropzone.options.bannersDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                maxFiles: 5,
            };
        </script>
    @endpush

</div>
