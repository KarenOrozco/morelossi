<section class="py-10">
    <div class="gallery">
        <input type="radio" name="slides" checked="checked" id="slide-1">
        <input type="radio" name="slides" id="slide-2">
        <input type="radio" name="slides" id="slide-3">
        <input type="radio" name="slides" id="slide-4">
        <input type="radio" name="slides" id="slide-5">
        <input type="radio" name="slides" id="slide-6">
        <ul class="gallery__slides">
            @foreach ($images as $image)
                <li class="gallery__slide">
                    <figure>
                        <div>
                            <img src="{{url('storage/'.$image->url)}}" alt="">
                        </div>
                    </figure>
                </li>
            @endforeach
        </ul>    
        <ul class="gallery__thumbnails">
            @for ($i = 0; $i < count($images); $i++)
                <li>
                    <label for="slide-{{$i+1}}"><img src="{{url('storage/'.$images[$i]->url)}}" alt=""></label>
                </li>
            @endfor
        </ul>
    </div>
</section>