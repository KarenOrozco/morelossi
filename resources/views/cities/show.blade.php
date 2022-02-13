<x-app-layout>
    @if ($city)
        <x-slot name="slot">
            <x-banner :title="$city->name" url="banners/banner-footer.jpg" />
            @livewire('cities.show', ['city' => $city])
        </x-slot>
    @else
        <div class="my-10 h-48 w-56 m-auto flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            {{-- <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div> --}}
            <h3>Sin resultados</h3>
        </div>
    @endif
    
</x-app-layout>