<x-app-layout>
    <x-slot name="slot">
        {{-- <livewire:slideshow /> --}}
        {{-- <x-banner :title="$category->name" url="banners/banner-footer.jpg" /> --}}
        
    
        @livewire('categories.show', ['category' => $category,'city' => $city, 'search' => $search])
    </x-slot>
</x-app-layout>