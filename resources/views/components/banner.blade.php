<div class="h-56 w-full sm:h-72 md:h-96 lg:w-full flex justify-center items-center bg-cover bg-fixed bg-center" style="background-image:  linear-gradient(
        rgba(86, 7, 12, 0.5),
        rgba(255, 198, 191, 0.5)
      ), url({{ asset('storage/'.$url) }})">

    <div class="flex-1 flex-col">

        <h1 class="text-white text-center">
            {{$title}}
        </h1>
        {{$slot}}
    </div>
</div>
