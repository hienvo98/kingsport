$(document).ready(function() {
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
        $('img#thumbnailImg').show();
    })

    $('#images_detail').on('change', function(e) {
        var files = e.target.files;
        if (files.length > 11) {
            alert("Chỉ được phép tải lên tối đa 11 ảnh.");
            $(this).val('');
            return false;
        }
        var slide = ``;
        for (var i = 0; i < this.files.length; i++) {
            slide += `<div class="swiper-slide" style="position:relative">
                <img class="img-fluid thumbnail" src="${URL.createObjectURL(this.files[i])}" alt="img">
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
                $(`#success`).click();
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    $(`.btnDelete`).click(deleteFunction);
    
    
});
var deleteFunction = function () {
    var route = $(this).data('route');
    $.ajax({
        url: route,
        type: 'get',
        success: function (response) {
            $('#success').click();
        },
        error: function (error) {
            if (error.responseJSON && error.responseJSON.errors) {
                $("html, body").animate({ scrollTop: 0 }, 'fast')
                var errors = error.responseJSON.errors;
                console.log("Lỗi cụ thể:");
                console.log(errors);
                var errorMessages = "";
                var typeError = 0;
                for (var key in errors) {
                    if (errors.hasOwnProperty(key) && key.split('.').length != 3) {
                        for (var keyChild of errors[key]) {
                            errorMessages += `<div class="alert alert-danger text-capitalize">
                                ${keyChild}
                            </div>`;
                        }
                    } else {
                        typeError++;
                    }
                }
                $(`div#errors`).append(errorMessages);
            }
        }
    })
};

const multipleCancelButton1 = new Choices(
    '#blog-tags',
    {
        allowHTML: true,
        removeItemButton: true,
    }
);

