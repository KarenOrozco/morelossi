<div>

    @push('css')
        <style>
            * {
                box-sizing: border-box;
            }

            .mySlides {
                display: none;
            }

            .imgSlides {
                vertical-align: middle;
            }

            /* Slideshow container */
            .slideshow-container {
                /* max-width: 1000px; */
                width: 50%;
                position: relative;
                margin: auto;
            }

            /* Caption text */
            .text {
                color: #f2f2f2;
                font-size: 15px;
                padding: 8px 12px;
                position: absolute;
                bottom: 8px;
                width: 100%;
                text-align: center;
            }

            /* Number text (1/3 etc) */
            .numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
            }

            /* The dots/bullets/indicators */
            .dot {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 0.6s ease;
            }

            .active {
                background-color: #717171;
            }

            /* Fading animation */
            .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 1.5s;
                animation-name: fade;
                animation-duration: 1.5s;
            }

            @-webkit-keyframes fade {
                from {
                    opacity: .4
                }

                to {
                    opacity: 1
                }
            }

            @keyframes fade {
                from {
                    opacity: .4
                }

                to {
                    opacity: 1
                }
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
                .text {
                    font-size: 11px
                }
            }
        </style>
    @endpush
    
    <h2>Automatic Slideshow</h2>
    <p>Change image every 2 seconds:</p>

    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img class="imgSlides" src="https://source.unsplash.com/1002x750" style="width:100%">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img class="imgSlides" src="https://source.unsplash.com/1002x751" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img class="imgSlides" src="https://source.unsplash.com/1002x752" style="width:100%">
            <div class="text">Caption Three</div>
        </div>

    </div>
    <br>

    <div style="text-align:center">
        <span id="dot-1" class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

    <div class="absolute z-10 w-full flex justify-center">
        {{-- @foreach ($slides as $slide) --}}
           
                <button
                    class="bg-pink-300 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-pink-600 hover:shadow-lg focus:outline-none focus:ring-transparent"
                ></button>

        {{-- @endforeach --}}
    </div>

    @push('script')
        <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) {
                    slideIndex = 1
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
                setTimeout(showSlides, 5000); // Change image every 2 seconds
            }
        </script>
    @endpush
</div>
