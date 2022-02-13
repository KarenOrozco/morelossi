<div class="wrapper">
    <div class="slideshows">
        <div class="slideshow slideshow--hero">
            <div class="slides-show">
                <div class="slide-s slide1"
                style="background-image: url({{asset('storage/banners/banner1.png')}})"></div>
                <div class="slide-s slide2"></div>
                <div class="slide-s slide3"></div>
            </div>
        </div>
        <div class="slideshow slideshow--contrast slideshow--contrast--before">
            <div class="slides-show">
                <div class="slide-s slide1"
                style="background-image: url({{asset('storage/banners/banner1.png')}})"></div>
                <div class="slide-s slide2"></div>
                <div class="slide-s slide3"></div>
            </div>
        </div>
        <div class="slideshow slideshow--contrast slideshow--contrast--after">
            <div class="slides-show">
                <div class="slide-s slide1"></div>
                <div class="slide-s slide2"></div>
                <div class="slide-s slide3"></div>
            </div>
        </div>

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
        {{-- <div class="absolute w-full flex justify-center px-4">
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
        </div> --}}
    </div>
</div>
