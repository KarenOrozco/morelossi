<x-app-layout>
    <x-slot name="slot">
        {{-- <livewire:slideshow /> --}}
        @livewire('directorio', ['categories' => $categories, 'city' => $city, 'search' => $search])
        {{-- @livewire('directorio') --}}

    </x-slot>
</x-app-layout>