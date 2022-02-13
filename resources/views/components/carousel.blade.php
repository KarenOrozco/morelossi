<div>
    <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full block mx-auto justify-center items-center bg-indigo-100">    
        <div class="mx-auto relative">
            <!-- Slides -->
            @foreach ($slides as $slide)
                @if ($activeSlide === $slide)
                    <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full font-bold text-5xl flex items-center bg-indigo-500 text-white rounded-lg">
                        <img class="h-56 w-full bg-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                            src="{{asset('storage/banners/banner'.$activeSlide.'.png')}}"
                            alt="">
                    </div>
                @endif
            @endforeach
    
            <!-- Prev/Next Arrows -->
            <div class="absolute inset-7 flex">
                <div class="flex items-center justify-start w-1/2">
                    <button
                        class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                        onclick="previousSlide">
                        &#8592;
                    </button>
                </div>
                <div class="flex items-center justify-end w-1/2">
                    <button
                        class="bg-indigo-100 text-indigo-500 hover:text-yellow-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent"
                        click={{$nextSlide()}}>
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
</div>