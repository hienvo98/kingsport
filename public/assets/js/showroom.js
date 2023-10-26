$(document).ready(function() {

    const multipleCancelButton1 = new Choices(
        '#blog-tags',
        {
            allowHTML: true,
            removeItemButton: true,
        }
    );
    const $titleInput = $('#blog-title');
    const $urlInput = $('#blog-url');

    $titleInput.on('input', function () {
        const title = $titleInput.val();

        const url = title
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[àáảãạâầấẩẫậăằắẳẵặ]/g, 'a')
            .replace(/[èéẻẽẹêềếểễệ]/g, 'e')
            .replace(/[ìíỉĩị]/g, 'i')
            .replace(/[òóỏõọôồốổỗộơờớởỡợ]/g, 'o')
            .replace(/[ùúủũụưừứửữự]/g, 'u')
            .replace(/[ỳýỷỹỵ]/g, 'y')
            .replace(/đ/g, 'd')
            .replace(/[^a-z0-9-]/g, '-')
            .replace(/--+/g, '-').replace(/^-+|-+$/g, '');
        $urlInput.val(url);
    });

    $(`input.thumbnail`).change(function () {
        $('img#thumbnailImg').attr('src', URL.createObjectURL(this.files[0]));
    })

    $('#images_detail').on('change', function(e) {
        var files = e.target.files;
        if (files.length > 11) {
            alert("Chỉ được phép tải lên tối đa 11 ảnh.");
            return;
        }
        var slide = ``;
        for (var i = 0; i < this.files.length; i++) {
            slide += `<div class="swiper-slide" style="position:relative">
                <img class="img-fluid thumbnail" data-num="${$(this).attr('data-color')}-${i}" src="${URL.createObjectURL(this.files[i])}" alt="img">
            </div>`;
        };
        $('#image-list').empty();
        $('#image-list').append(slide);
    });


    $('#showroom-form').submit(function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        console.log(formData);
        const quill = new Quill('#blog-content', {
            theme: 'snow'
        });
        const quillContent = quill.root.innerHTML;
        formData.append('blog_content', quillContent);
        $.ajax({
            type: 'POST',
            url: '/admin/showroom/store',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                location.reload();
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    
                }, 3000);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});
