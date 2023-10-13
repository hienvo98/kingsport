$(document).ready(function() {
    $('#images').change(function(e) {
        var files = e.target.files;
        var imageList = $('#image-list');

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var imageUrl = e.target.result;
                var img = $('<img>').attr('src', imageUrl);
                var swiperSlide = $('<div class="swiper-slide"></div>');
                swiperSlide.append(img);
                imageList.find('.swiper-wrapper').append(swiperSlide);
            };

            reader.readAsDataURL(file);
        }

        // Khởi tạo hoặc cập nhật Swiper sau khi thêm hình ảnh mới
        var mySwiper = new Swiper('.swiper', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
});
