<x-app-layout>
    <x-slot name="slot">
        @livewire('events', ['events' => $events])
        {{-- @livewire('events') --}}
    </x-slot>
</x-app-layout>

{{-- https://codepen.io/romswellparian/pen/raPObG --}}

{{-- https://tailwinduikit.com/components/webapp/calendar/calendar --}}