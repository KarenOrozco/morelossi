<div>
    <h2>{{ $title }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($elements as $element)
            <article class="w-full h-80 bg-cover bg-center"
                style="background-image: url({{ url('storage/' . $element->images[0]->url) }})">

                <div class="w-full h-full px-8 flex flex-col justify-center">
                    <div>
                        @if ($type === 'companies')
                            @foreach ($element->categories as $category)
                                <a href=""
                                    class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{ $category->name }}</a>
                            @endforeach
                        @endif
                    </div>
                    <h1 class="text-white">
                        <a href="">
                            {{ $element->name }}
                        </a>
                    </h1>
                    {{ $slot }}
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $elements->links() }}
    </div>
</div>
