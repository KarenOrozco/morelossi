<x-dashboard-layout>

    <x-slot name="header">
        <h1 class="uppercase">
            {{-- Negocio {{$store->name}} --}}
        </h1>
    </x-slot>

    <x-slot name="slot">
        @livewire('dashboard.categories.edit', ['category' => $category])
    </x-slot>

</x-dashboard-layout>