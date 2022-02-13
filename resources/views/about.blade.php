<x-app-layout>

    @php
        $banners = ['banners/banner1.png','banners/banner2.png','banners/banner3.png']; 
    @endphp

    <x-slideshow-3 :banners="$banners" title="¿QUIÉNES SOMOS?"/>
    {{-- <x-banner title="¿QUIENES SOMOS?" url="banners/banner-footer.jpg" /> --}}

    <div class="py-12 bg-white">
        <div class="">
            <div class="text-center">
                {{-- <img class="m-auto w-2/5 md:w-3/12" src="{{ asset('storage/logotipo/morelossi.png') }}"> --}}
                {{-- <h2 class="uppercase">¿QUIENES SOMOS?</h2> --}}
                <h2 class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-rose-400 tracking-tight mb-8">¿Quiénes somos?</h2>

                <p class="mt-4 text-xl text-center text-gray-600
                    lg:mx-auto sm:text-2xl font-medium sm:leading-10 space-y-6 max-w-4xl mx-auto mb-6">
                    Somos el primer <span class="text-rose-600 font-bold">directorio empresarial - gratuito</span> para EMPRENDEDORES y PYMES - EN EL ESTADO DE MORELOS  apoyando la reactivación económica de fácil acceso para navegar  y segmentado por zona geográfica.
                </p>
            </div>

            <div class="row">
                <div>
                    <svg id="" preserveAspectRatio="xMidYMax meet" class="svg-separator sep3" viewBox="0 0 1600 100" style="display: block;" data-height="100">
                    <path class="" style="opacity: 1;fill: #FB6B90;" d="M-40,71.627C20.307,71.627,20.058,32,80,32s60.003,40,120,40s59.948-40,120-40s60.313,40,120,40s60.258-40,120-40s60.202,40,120,40s60.147-40,120-40s60.513,40,120,40s60.036-40,120-40c59.964,0,60.402,40,120,40s59.925-40,120-40s60.291,40,120,40s60.235-40,120-40s60.18,40,120,40s59.82,0,59.82,0l0.18,26H-60V72L-40,71.627z"></path>
                    <path class="" style="opacity: 1;fill: #FB4570;" d="M-40,83.627C20.307,83.627,20.058,44,80,44s60.003,40,120,40s59.948-40,120-40s60.313,40,120,40s60.258-40,120-40s60.202,40,120,40s60.147-40,120-40s60.513,40,120,40s60.036-40,120-40c59.964,0,60.402,40,120,40s59.925-40,120-40s60.291,40,120,40s60.235-40,120-40s60.18,40,120,40s59.82,0,59.82,0l0.18,14H-60V84L-40,83.627z"></path>
                    <path class="" style="fill: #FDA4AF;" d="M-40,95.627C20.307,95.627,20.058,56,80,56s60.003,40,120,40s59.948-40,120-40s60.313,40,120,40s60.258-40,120-40s60.202,40,120,40s60.147-40,120-40s60.513,40,120,40s60.036-40,120-40c59.964,0,60.402,40,120,40s59.925-40,120-40s60.291,40,120,40s60.235-40,120-40s60.18,40,120,40s59.82,0,59.82,0l0.18,138H-60V96L-40,95.627z"></path>
                    </svg>
                </div>

                <div class="pt-8 text-center bg-rose-300">
                    <h2 style="color: #FFE4E6;" class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-gray-900 tracking-tight mb-8">Hover...</h2>
                    <p class="mt-4 text-xl text-center text-white
                        lg:mx-auto sm:text-2xl font-medium sm:leading-10 space-y-6 max-w-4xl mx-auto">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia culpa sit id corporis laborum saepe nam in vero officiis voluptatem eius, ullam, repellat dolor! Quae distinctio qui laboriosam suscipit nesciunt!
                    </p>

                </div>
            </div>

            <div class="row">
                <div class="bg-rose-300">
                    <svg id="" preserveAspectRatio="xMidYMax meet" class="svg-separator sep3" viewBox="0 0 1600 100" style="display: block;" data-height="100">
                    <path class="" style="opacity: 1;fill: #FB6B90;" d="M-40,71.627C20.307,71.627,20.058,32,80,32s60.003,40,120,40s59.948-40,120-40s60.313,40,120,40s60.258-40,120-40s60.202,40,120,40s60.147-40,120-40s60.513,40,120,40s60.036-40,120-40c59.964,0,60.402,40,120,40s59.925-40,120-40s60.291,40,120,40s60.235-40,120-40s60.18,40,120,40s59.82,0,59.82,0l0.18,26H-60V72L-40,71.627z"></path>
                    <path class="" style="opacity: 1;fill: #FB4570;" d="M-40,83.627C20.307,83.627,20.058,44,80,44s60.003,40,120,40s59.948-40,120-40s60.313,40,120,40s60.258-40,120-40s60.202,40,120,40s60.147-40,120-40s60.513,40,120,40s60.036-40,120-40c59.964,0,60.402,40,120,40s59.925-40,120-40s60.291,40,120,40s60.235-40,120-40s60.18,40,120,40s59.82,0,59.82,0l0.18,14H-60V84L-40,83.627z"></path>
                    <path class="" style="fill: #ffffff;" d="M-40,95.627C20.307,95.627,20.058,56,80,56s60.003,40,120,40s59.948-40,120-40s60.313,40,120,40s60.258-40,120-40s60.202,40,120,40s60.147-40,120-40s60.513,40,120,40s60.036-40,120-40c59.964,0,60.402,40,120,40s59.925-40,120-40s60.291,40,120,40s60.235-40,120-40s60.18,40,120,40s59.82,0,59.82,0l0.18,138H-60V96L-40,95.627z"></path>
                    </svg>
                </div>

                <div class="pt-8 text-center">
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-rose-400 tracking-tight mb-8">Sección 2...</h2>
                    <p class="mt-4 text-xl text-center
                        lg:mx-auto sm:text-2xl font-medium sm:leading-10 space-y-6 max-w-4xl mx-auto">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia culpa sit id corporis laborum saepe nam in vero officiis voluptatem eius, ullam, repellat dolor! Quae distinctio qui laboriosam suscipit nesciunt!
                    </p>

                </div>
            </div>

            <div class="row">
                <div class="pt-8 text-center">
                    <h2 style="color: #BCECE0;" class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-gray-900 tracking-tight mb-8">Sección 3...</h2>
                    <p class="mt-4 text-xl text-center
                        lg:mx-auto sm:text-2xl font-medium sm:leading-10 space-y-6 max-w-4xl mx-auto">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia culpa sit id corporis laborum saepe nam in vero officiis voluptatem eius, ullam, repellat dolor! Quae distinctio qui laboriosam suscipit nesciunt!
                    </p>

                </div>
            </div>

            <div class="row">
                <div class="pt-8 text-center">
                    <h2 class="text-3xl sm:text-5xl lg:text-6xl leading-none font-extrabold text-rose-400 tracking-tight mb-8">Sección 4...</h2>
                    <p class="mt-4 text-xl text-center
                        lg:mx-auto sm:text-2xl font-medium sm:leading-10 space-y-6 max-w-4xl mx-auto">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia culpa sit id corporis laborum saepe nam in vero officiis voluptatem eius, ullam, repellat dolor! Quae distinctio qui laboriosam suscipit nesciunt!
                    </p>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>