<div class="wrapper">
    <div class="slideshows" x-init="setInterval($wire.nextSlide(), 10000)">
        <div class="slideshow slideshow--hero">
            <div class="slides-show">

                {{-- @foreach ($slides as $slide) --}}
                @for ($i = 0; $i < count($slides); $i++)
                    @if ($activeSlide === $slides[$i]) 
                        <div class="slide-s slide{{ $slides[$i] }}"
                            style="background-image: url({{ asset('storage/banners/banner' . $slides[$i] . '.png') }})"></div>
                    @endif
                @endfor
            </div>
        </div>
        <div class="slideshow slideshow--contrast slideshow--contrast--before">
            <div class="slides-show">

                @for ($i = 0; $i < count($slides); $i++)
                    @if ($activeSlide === $slides[$i]) 
                        <div class="slide-s slide{{ $i + 1 }}" 
                            style="background-image: linear-gradient(to bottom, rgba(200,200,75,0.25) 0, rgba(200,75,75,0.5) 100%),url({{ asset('storage/banners/banner' . $slides[$i] . '.png') }})"></div> 
                    @endif
                @endfor
            </div>
        </div>
        <div class="slideshow slideshow--contrast slideshow--contrast--after">
            <div class="slides-show">

                @for ($i = 0; $i < count($slides); $i++)
                    @if ($activeSlide === $slides[$i]) 
                        <div class="slide-s slide{{ $i + 1 }}" 
                            style="background-image: linear-gradient(to bottom, rgba(200,200,75,0.25) 0, rgba(200,75,75,0.5) 100%),url({{ asset('storage/banners/banner' . $slides[$i] . '.png') }})"></div> 
                    @endif
                @endfor
            </div>
        </div>

        <!-- Prev/Next Arrows -->
        {{-- <div class="absolute z-10 inset-7 flex">
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
        </div> --}}


        <div class="arrows">
            <div class="arrow prev" wire:click="previousSlide">
                <span class="svg svg-arrow-left">
                    <svg version="1.1" id="svg4-Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px"
                        viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve">
                        <path
                            d="M13,26c-0.256,0-0.512-0.098-0.707-0.293l-12-12c-0.391-0.391-0.391-1.023,0-1.414l12-12c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414L2.414,13l11.293,11.293c0.391,0.391,0.391,1.023,0,1.414C13.512,25.902,13.256,26,13,26z" />
                    </svg>
                    <span class="alt sr-only"></span>
                </span>
            </div>
            <div class="arrow next" wire:click="nextSlide">
                <span class="svg svg-arrow-right">
                    <svg version="1.1" id="svg5-Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px"
                        viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve">
                        <path
                            d="M1,0c0.256,0,0.512,0.098,0.707,0.293l12,12c0.391,0.391,0.391,1.023,0,1.414l-12,12c-0.391,0.391-1.023,0.391-1.414,0s-0.391-1.023,0-1.414L11.586,13L0.293,1.707c-0.391-0.391-0.391-1.023,0-1.414C0.488,0.098,0.744,0,1,0z" />
                    </svg>
                    <span class="alt sr-only"></span>
                </span>
            </div>
        </div>

        <!-- Buttons -->
        <div class="absolute z-10 w-full flex justify-center">
            @foreach ($slides as $slide)
                @if ($slide === $activeSlide)
                    <button
                        class="bg-pink-600 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-pink-600 hover:shadow-lg focus:outline-none focus:ring-transparent"
                        wire:click="setActiveSlide({{ $slide }})"></button>
                @else
                    <button
                        class="bg-pink-300 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-pink-600 hover:shadow-lg focus:outline-none focus:ring-transparent"
                        wire:click="setActiveSlide({{ $slide }})"></button>
                @endif

            @endforeach
        </div>
    </div>
</div>
