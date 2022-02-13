<div class="container ">
    
    @push('css')
        <link rel="dns-prefetch" href="//unpkg.com" />
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    @endpush

    {{-- Lista de usuarios --}}
    <div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
        <h1 class="text-3xl">EVENTOS</h1>
        {{-- <x-secondary-button href="{{route('dashboard.events.create')}}" >
            Crear evento
        </x-secondary-button> --}}
        @livewire('dashboard.events.create')
    </div>

    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-center">

            <x-jet-secondary-button wire:click="$set('vieww', 'calendar')">
                <i class="fas fa-calendar cursor-pointer {{ $vieww === 'calendar' ? 'text-pink-500' : ''}}"></i>
            </x-jetsecondary-button>

            <x-jet-secondary-button wire:click="$set('vieww', 'list')">
                <i class="fas fa-th-list cursor-pointer {{ $vieww === 'list' ? 'text-pink-500' : ''}}"></i>
            </x-jet-secondary-button>

        </div>
    </div>

    <div class="{{ $vieww === 'calendar' ? '' : 'hidden'}}">
        <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
            <div class="container mx-auto py-2 md:py-4">
                
                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <div class="flex items-center justify-between py-2 px-6">
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                            <button 
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
                                :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                :disabled="month == 0 ? true : false"
                                @click="month--; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>  
                            </button>
                            <div class="border-r inline-flex h-6"></div>		
                            <button 
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
                                :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                :disabled="month == 11 ? true : false"
                                @click="month++; getNoOfDays()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>									  
                            </button>
                        </div>
                    </div>	

                    <div class="-mx-1 -mb-1">
                        <div class="flex flex-wrap" style="margin-bottom: -40px;">
                            <template x-for="(day, index) in DAYS" :key="index">	
                                <div style="width: 14.26%" class="px-2 py-2">
                                    <div
                                        x-text="day" 
                                        class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                                </div>
                            </template>
                        </div>

                        <div class="flex flex-wrap border-t border-l">
                            <template x-for="blankday in blankdays">
                                <div 
                                    style="width: 14.28%; height: 120px"
                                    class="text-center border-r border-b px-4 pt-2"	
                                ></div>
                            </template>	
                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">	
                                <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                    <div
                                        @click="showEventModal(date)"
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"	
                                    ></div>
                                    <div style="height: 80px;" class="overflow-y-auto mt-1">
                                        <!-- <div 
                                            class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                                            x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                                            x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

                                        <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">	
                                            <div
                                                @click="show(event.event_id)"
                                                class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer"
                                                :class="{
                                                    'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                                                    'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                                                    'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                                                    'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                                                    'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple',
                                                    'border-pink-200 text-pink-800 bg-pink-100': event.event_theme === 'pink'
                                                }"
                                            >
                                                {{-- <x-show-button nameFunction="show" item="{{$event->id}}"/> --}}
                                                <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                                                <p x-text="event.event_time" class="text-sm truncate leading-tight"></p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            {{-- <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
                <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
                    <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                        x-on:click="openEventModal = !openEventModal">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                        </svg>
                    </div>

                    <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">
                        
                        <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Crear evento</h2>
                    
                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Nombre del evento</label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_title">
                        </div>

                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Fecha</label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
                        </div>

                        <div class="inline-block w-64 mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Selecciona un tema</label>
                            <div class="relative">
                                <select @change="event_theme = $event.target.value;" x-model="event_theme" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                                        <template x-for="(theme, index) in themes">
                                            <option :value="theme.value" x-text="theme.label"></option>
                                        </template>
                                    
                                </select>
                            </div>
                        </div>
    
                        <div class="mt-8 text-right">
                            <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
                                Cancelar
                            </button>	
                            <button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm" @click="addEvent()">
                                Guardar evento
                            </button>	
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- /Modal -->
        </div>
    </div>

    <div class="{{ $vieww === 'list' ? '' : 'hidden'}}">

    </div>
    
    @if ($vieww === 'list')
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

            @if (count($events))
                <table class="table-auto w-full text-gray-600 bg-white">
                    <thead class="border-b border-gray-300 bg-pink-500 text-white uppercase text-xs font-bold">
                        <tr class="text-left">
                            <th class="py-2 px-6
                            sticky top-0 border-b tracking-wider text-left
                            ">Evento</th>
                            <th class="py-2 px-6
                            sticky top-0 border-b tracking-wider text-left
                            ">Descripción</th>
                            <th class="py-2 px-6
                            sticky top-0 border-b tracking-wider text-left
                            ">Fecha</th>
                            <th class="py-2 px-6
                            sticky top-0 border-b tracking-wider text-left 
                            ">Acción</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-300">
                        @foreach ($events as $item)
                            <tr>
                                <td class="px-6 py-2 border-dashed border-t border-gray-200 mx-auto">
                                        {{$item->name}}
                                </td>
                                <td class="px-6 py-2 mx-auto border-dashed border-t border-gray-200">
                                    {{Str::limit($item->description,100)}}
                                </td>
                                <td class="px-6 py-2 mx-auto border-dashed border-t border-gray-200">
                                    {{$item->start_time}}
                                </td>
                                <td class="px-6 py-2 text-center">
                                    <div class="flex font-semibold">
                                        <x-show-button nameFunction="show" item="{{$item->id}}"/>
                                        <x-edit-button route='dashboard.events.edit' :param="$item" />
                                        <x-delete-button nameFunction="deleteEvent" item="{{$item->id}}" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach        
                    </tbody>
                </table>

                @if($events->hasPages())
                    <div class="px-6 py-3 bg-pink-100">
                        {{ $events->links() }}
                    </div>
                @endif
            @else
                <div class="py-2 mx-auto text-center bg-pink-100">
                    <p>No se encontraron registros</p>
                </div>
            @endif
        
        </div>    
    @endif



     {{-- Modal --}}
    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
            {{$form['title']}}
        </x-slot>

        <x-slot name="content">

            @if (!empty($event))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                </div>

                <section>
                    <ul class="flex flex-wrap">
                        <li class="relative">
                            @if (count($event->images))
                                <img class="m-auto w-1/2 md:w-1/2 object-cover" src="{{ Storage::url($event->images->first()->url) }}">   
                            @endif
                        </li>
                    </ul>
                </section>
                <section>
                    <p>Nombre: {{$event->name}}</p>
                    <p>Slug: {{$event->slug}}</p>
                    <p>Descripción: {{$event->description}}</p>
                    <p>Fecha: {{$event->start_time}}</p>
                </section>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                OK
            </x-jet-secondary-button>
        </x-slot>

    </x-jet-dialog-modal>   

    @push('script')
        <script>
            const MONTH_NAMES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            const DAYS = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        
            function app() {
                return {
                    month: '',
                    year: '',
                    no_of_days: [],
                    blankdays: [],
                    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    
                    events: @entangle('eventsCalendar'),
                    event_title: '',
                    event_date: '',
                    event_theme: 'blue',
    
                    themes: [
                        {
                            value: "blue",
                            label: "Blue Theme"
                        },
                        {
                            value: "red",
                            label: "Red Theme"
                        },
                        {
                            value: "yellow",
                            label: "Yellow Theme"
                        },
                        {
                            value: "green",
                            label: "Green Theme"
                        },
                        {
                            value: "purple",
                            label: "Purple Theme"
                        }
                    ],
    
                    openEventModal: false,
    
                    initDate() {
                        let today = new Date();
                        this.month = today.getMonth();
                        this.year = today.getFullYear();
                        this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                    },
    
                    isToday(date) {
                        const today = new Date();
                        const d = new Date(this.year, this.month, date);
    
                        return today.toDateString() === d.toDateString() ? true : false;
                    },

                    show(eventId) {
                        Livewire.emitTo('dashboard.events.index', 'show-event', eventId)
                    },
    
                    // showEventModal(date) {
                    //     // open the modal
                    //     this.openEventModal = true;
                    //     this.event_date = new Date(this.year, this.month, date).toDateString();
                    //     // this.event_date = Carbon::now();
                    // },
    
                    // addEvent() {
                    //     if (this.event_title == '') {
                    //         return;
                    //     }
    
                    //     this.events.push({
                    //         event_date: this.event_date,
                    //         event_title: this.event_title,
                    //         event_theme: this.event_theme
                    //     });
    
                    //     console.log(this.events);
    
                    //     // clear the form data
                    //     this.event_title = '';
                    //     this.event_date = '';
                    //     this.event_theme = 'blue';
    
                    //     //close the modal
                    //     this.openEventModal = false;
                    // },
    
                    getNoOfDays() {
                        let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
    
                        // find where to start calendar day of week
                        let dayOfWeek = new Date(this.year, this.month).getDay();
                        let blankdaysArray = [];
                        for ( var i=1; i <= dayOfWeek; i++) {
                            blankdaysArray.push(i);
                        }
    
                        let daysArray = [];
                        for ( var i=1; i <= daysInMonth; i++) {
                            daysArray.push(i);
                        }
                        
                        this.blankdays = blankdaysArray;
                        this.no_of_days = daysArray;
                    }
                }
            }

            //-----------------
            Livewire.on('deleteEvent', eventId => {
            
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

                        Livewire.emitTo('dashboard.events.index', 'delete-event', eventId)

                        Swal.fire(
                            '¡Eliminado!',
                            'El evento ha sido eliminado',
                            'success'
                        )
                    }
                })

            });
        </script>
    @endpush
</div>

