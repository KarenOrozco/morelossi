<x-app-layout>
    <div class="container py-8">
        <ul>
            @forelse($stores as $store)
                <x-store-list :store="$store" />

            @empty
            
                <li class="bg-white rounded-lg shadow-2xl">
                    <div class="p-4">
                        <p class="text-lg font-semibold text-gray-700">
                            Ningún producto coinide con esos parametros
                        </p>
                    </div>
                </li>

            @endforelse
        </ul>

        <div class="mt-4">
            {{$stores->links()}}
        </div>
    </div>
</x-app-layout>