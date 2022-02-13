 <!-- Required font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <style>
    
    </style>

@props(['banners'])
<div class="carousel relative overflow-hidden shadow-xl">
    <div class="carousel-inner relative overflow-hidden w-full">

        {{var_dump($banners)}}
    @for ($i = 0; $i < count($banners)-1; $i++)
        <input class="carousel-open" type="radio" id="carousel-{{$i+1}}" name="carousel" aria-hidden="true" style="display:none"
            checked="checked">
        
        <div class="carousel-item absolute opacity-0 bg-center" style="height:500px; background-image: url({{ asset('storage/banners/banner' . $banners[$i] . '.png') }})"></div>
        
        @if ($i === 0)
            <label for="carousel-{{count($banners)-1}}"
                class="control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-rose-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto flex justify-center content-center"><i
                class="fas fa-angle-left mt-3"></i></label>
            
            <label for="carousel-{{$i+2}}"
                class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-rose-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto"><i
                class="fas fa-angle-right mt-3"></i></label>
        @else
            @if ($i === count($banners)-1)
                <label for="carousel-{{$i}}"
                    class="control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-rose-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto flex justify-center content-center"><i
                    class="fas fa-angle-left mt-3"></i></label>
                
                <label for="carousel-0"
                    class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-rose-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto"><i
                    class="fas fa-angle-right mt-3"></i></label>
            @else
                <label for="carousel-{{$i}}"
                    class="control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-rose-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto flex justify-center content-center"><i
                    class="fas fa-angle-left mt-3"></i></label>
                
                <label for="carousel-{{$i+2}}"
                    class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-rose-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto"><i
                    class="fas fa-angle-right mt-3"></i></label>
            @endif
        @endif
    @endfor
            
    <!--Slide 1-->
    {{-- <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" style="display:none"
       checked="checked">
       
    <div class="carousel-item absolute opacity-0 bg-center" style="height:500px; background-image: url(https://mdbootstrap.com/img/new/slides/052.jpg)"></div>
    <label for="carousel-3"
       class="control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto flex justify-center content-center"><i
         class="fas fa-angle-left mt-3"></i></label>
    <label for="carousel-2"
       class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto"><i
         class="fas fa-angle-right mt-3"></i></label> --}}
 
    <!--Slide 2-->
    {{-- <input class="carousel-open" type="radio" id="carousel-2" name="carousel" aria-hidden="true" style="display:none">
    <div class="carousel-item absolute opacity-0 bg-center" style="height:500px; background-image: url(https://mdbootstrap.com/img/new/slides/043.jpg)"></div>
    <label for="carousel-1"
        class=" control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto"><i
        class="fas fa-angle-left mt-3"></i></label>
    <label for="carousel-3"
        class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto"><i
        class="fas fa-angle-right mt-3"></i></label> --}}
 
    <!--Slide 3-->
    {{-- <input class="carousel-open" type="radio" id="carousel-3" name="carousel" aria-hidden="true" style="display:none">
    <div class="carousel-item absolute opacity-0" style="height:500px; background-image: url(https://mdbootstrap.com/img/new/slides/054.jpg)"></div>
    <label for="carousel-2"
        class="control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto"><i
        class="fas fa-angle-left mt-3"></i></label>
    <label for="carousel-1"
        class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto"><i
        class="fas fa-angle-right mt-3"></i></label> --}}
 
    <!-- Add additional indicators for each slide-->
    <ol class="carousel-indicators">
        <li class="inline-block mr-3">
            <label for="carousel-1"
                class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-rose-700">•</label>
        </li>
        <li class="inline-block mr-3">
            <label for="carousel-2"
                class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-rose-700">•</label>
        </li>
        <li class="inline-block mr-3">
            <label for="carousel-3"
                class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-rose-700">•</label>
        </li>
    </ol>
 
   </div>
</div>