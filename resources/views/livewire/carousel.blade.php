{{-- <div class="bg-indigo-100 h-screen flex flex-col justify-center items-center"> --}}
<div class="h-56 w-full sm:h-72 md:h-96 lg:w-full block mx-auto justify-center items-center bg-indigo-100">    
    <div class="mx-auto relative">
        <!-- Slides -->
        @foreach ($slides as $slide)
            @if ($activeSlide === $slide)
                <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full flex justify-center items-center bg-cover bg-center bg-indigo-500"
                    style="background-image: linear-gradient(
                        rgba(0, 0, 0, 0.5),
                        rgba(0, 0, 0, 0.5)
                    ), url({{asset('storage/banners/banner'.$activeSlide.'.png')}})">
                    {{-- <img class="h-56 w-full bg-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                        src="{{asset('storage/banners/banner'.$activeSlide.'.png')}}"
                        alt=""> --}}
                  
                    <h1 class="text-4xl text-white leading-8 font-bold text-center">
                        <a href="">
                            Texto de la imagen
                        </a>
                    </h1>
                   
                  
                </div>
            @endif
            
        @endforeach

        <!-- Prev/Next Arrows -->
        <div class="absolute inset-7 flex">
            <div class="flex items-center justify-start w-1/2">
                <button
                    class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                    wire:click="previousSlide">
                    &#8592;
                </button>
            </div>
            <div class="flex items-center justify-end w-1/2">
                <button
                    class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                    wire:click="nextSlide">
                    &#8594;
                </button>
            </div>
        </div>

        <!-- Buttons -->
        <div class="absolute w-full flex justify-center px-4">
            @foreach ($slides as $slide)
                @if ($slide === $activeSlide)
                    <button 
                        class="bg-indigo-600 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-indigo-600 hover:shadow-lg"
                        wire:click="setActiveSlide({{ $slide }})"></button>
                @else
                    <button 
                        class="bg-indigo-300 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-indigo-600 hover:shadow-lg"
                        wire:click="setActiveSlide({{ $slide }})"></button>
                @endif
                
            @endforeach
        </div>
    </div>
</div>

{{-- <div class="bg-indigo-100 h-screen flex flex-col justify-center items-center relative">

    <div class="mx-auto relative" x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }">
        <!-- Slides -->
        <template x-for="slide in slides" :key="slide">
            <div x-show="activeSlide === slide"
                class="font-bold text-5xl h-screen flex items-center bg-indigo-500 text-white rounded-lg">
                <span class="w-12 text-center" x-text="slide"></span>
                <span class="text-teal-300">/</span>
                <span class="w-12 text-center" x-text="slides.length"></span>

                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                    src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                    alt="">
            </div>
        </template>

        <!-- Prev/Next Arrows -->
        <div class="absolute inset-7 flex">
            <div class="flex items-center justify-start w-1/2">
                <button
                    class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6"
                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                    &#8592;
                </button>
            </div>
            <div class="flex items-center justify-end w-1/2">
                <button
                    class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6"
                    x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                    &#8594;
                </button>
            </div>
        </div>

        <!-- Buttons w-full px-4 absolute-->
        <div class="relative flex items-center justify-center ">
            <template x-for="slide in slides" :key="slide">
               
                <button
                    class="w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-indigo-600 hover:shadow-lg"
                    :class="{ 
                'bg-yellow-600': activeSlide === slide,
                'bg-indigo-300': activeSlide !== slide 
            }" x-on:click="activeSlide = slide"></button>
            </template>
        </div>
    </div>
</div> --}}

{{-- <div class="carousel relative shadow-2xl bg-white">
    <div class="carousel-inner relative overflow-hidden w-2/3">
        <!--Slide 1-->
        <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden=""
            checked="checked">
        <div class="carousel-item absolute opacity-0" style="height:75vh;">
            <div class="block h-full w-full bg-yellow-500 text-white text-5xl text-center">Slide 1</div>
        </div>
        <label for="carousel-3"
            class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-yellow-500 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-2"
            class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!--Slide 2-->
        <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0" style="height:75vh;">
            <div class="block h-full w-full bg-yellow-500 text-white text-5xl text-center">Slide 2</div>
        </div>
        <label for="carousel-1"
            class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-3"
            class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!--Slide 3-->
        <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0" style="height:75vh;">
            <div class="block h-full w-full bg-yellow-500 text-white text-5xl text-center">Slide 3</div>
        </div>
        <label for="carousel-2"
            class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        <label for="carousel-1"
            class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

        <!-- Add additional indicators for each slide-->
        <ol class="carousel-indicators">
            <li class="inline-block mr-3">
                <label for="carousel-1"
                    class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
            </li>
            <li class="inline-block mr-3">
                <label for="carousel-2"
                    class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
            </li>
            <li class="inline-block mr-3">
                <label for="carousel-3"
                    class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
            </li>
        </ol>
    </div>
</div> --}}
