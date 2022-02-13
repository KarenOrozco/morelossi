<x-app-layout>
    <x-slideshow-2 />
    
    <div class="container bg-blue-300">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($companies as $company)
                @foreach ($company->images as $image)
                    <article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" 
                        style="background-image: url({{url('storage/'.$image->url)}})">

                        <div class="w-full h-full px-8 flex flex-col justify-center">

                            <div>
                                @foreach ($company->categories as $category)
                                    <a href="" class="inline-block px-3 h-6 bg-gray-600 text-white rounded-full">{{$category->name}}</a>
                                @endforeach
                            </div>

                            <h1 class="text-white">
                                <a href="">
                                    {{$company->name}}
                                </a>
                            </h1>
                        </div>
                    </article>
                @endforeach
            @endforeach 
        </div>
    </div>
</x-app-layout>