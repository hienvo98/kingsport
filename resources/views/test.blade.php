<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.css') }}">

    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <title>Document</title>
</head>

<body>
    <style>
        .swiper {
            width: 600px;
            height: 300px;
        }
    </style>
    <!-- Slider main container -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="" alt="Slide 1">
                <h2>Slide 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod tincidunt odio, non semper
                    velit lacinia ac.</p>
            </div>
            <div class="swiper-slide">
                <img src="" alt="Slide 1">
                <h2>Slide 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod tincidunt odio, non semper
                    velit lacinia ac.</p>
            </div>
            <div class="swiper-slide">
                <img src="" alt="Slide 1">
                <h2>Slide 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod tincidunt odio, non semper
                    velit lacinia ac.</p>
            </div>
            <div class="swiper-slide">
                <img src="" alt="Slide 1">
                <h2>Slide 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod tincidunt odio, non semper
                    velit lacinia ac.</p>
            </div>
            <div class="swiper-slide">
                <img src="" alt="Slide 1">
                <h2>Slide 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod tincidunt odio, non semper
                    velit lacinia ac.</p>
            </div>
            <div class="swiper-slide">
                <img src="" alt="Slide 1">
                <h2>Slide 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas euismod tincidunt odio, non semper
                    velit lacinia ac.</p>
            </div>
        </div>
    </div>
    <script>
        const swiper = new Swiper(".swiper-container", {
            direction: "horizontal", // Thiết lập swiper theo chiều ngang
            slidesPerView: 3, // Chỉ hiển thị một slide cùng một lúc
            autoplay: true, // Bật chế độ tự động phát swiper với thời gian trễ 3000 mili giây
        });
    </script>
</body>

</html>
