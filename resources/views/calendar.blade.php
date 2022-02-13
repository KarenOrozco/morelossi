<x-dashboard-layout>
    <x-slot name="header">
    </x-slot>
    <x-slot name="slot">
        {{-- @livewire('calendar', ['events' => $events]) --}}
        @livewire('calendar')
    </x-slot>
</x-dashboard-layout>