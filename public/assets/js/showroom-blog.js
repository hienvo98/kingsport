$(document).ready(function () {
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
    //cập nhật ảnh detail của showroom
    var html = $(`#image-list`).data('images');
    if (html) $(`#image-list`).html(html);

    $(`input.thumbnail`).change(function () {
        $('img#thumbnailImg').attr('src', URL.createObjectURL(this.files[0]));
        $('img#thumbnailImg').show();
    })
    //xử lý upload image-detail của showroom
    $('#images_detail').on('change', function (e) {
        var files = e.target.files;
        if($(this).hasClass('showroom') && files.length > 11){
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
    //submit form cập nhật (dùng chung)
    $(`form.form-update`).submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        if($(`div#blog-content`).text()) {
            var quillContent = quill.root.innerHTML;
            formData.append('content', quillContent);
        }
        var productInArticle = $(`select#choices-multiple-groups`).val(); //dùng cho article
        formData.append('productInArticle', productInArticle);
        $.ajax({
            url: $(this).data('route'),
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#success').click();
            },
            error: function (error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    $("html, body").animate({ scrollTop: 0 }, 'fast')
                    var errors = error.responseJSON.errors;
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
    })
    //submit form create (dùng chung)
    $('form.form-create').submit(function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        if($(`div#blog-content`).text()) {
            var quillContent = quill.root.innerHTML;
            formData.append('content', quillContent);
        }
        var productInArticle = $(`select#choices-multiple-groups`).val(); //dùng cho article, event
        formData.append('productInArticle', productInArticle);
        $.ajax({
            type: 'POST',
            url: $(this).data('route'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#success').click();
            },
            error: function (error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    $("html, body").animate({ scrollTop: 0 }, 'fast')
                    var errors = error.responseJSON.errors;
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
        });
    });
    //xử lý lọc ajax(dùng chung)
    $(`a.filter`).click(function () {
        // Tạo một URL mới dựa trên ID của danh mục
        var newUrl = $(this).data('update-url');
        // Sử dụng pushState để cập nhật URL
        window.history.pushState({}, '', newUrl);
        var route = $(this).data('route-filter');
        $.ajax({
            url: route,
            type: 'get',
            success: function (response) {
                $(`div#all-tasks`).children('div').html(response.all);
                $(`div#pending`).children('div').html(response.off);
                $(`div#completed`).children('div').html(response.on);
                $(`.btnDelete`).click(deleteFunction);
                $('nav#nav').html(response.nav);
            },
            error: function (error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    var errors = error.responseJSON.errors;
                    console.log("Lỗi cụ thể:");
                    console.log(errors);
                }
            }
        })
    })
    //xử lý tìm kiếm jax (dùng chung)
    var debounceTimer;
    $(`input#search`).on('input', function () {
        clearTimeout(debounceTimer); // Xóa bất kỳ hẹn giờ nào còn tồn tại

        debounceTimer = setTimeout(function () {
            // Thực hiện tìm kiếm ở đây sau khi người dùng ngưng gõ trong 0.5 giây
            var searchTerm = $(`input#search`).val();
            if (searchTerm.trim() !== '') {
                $(`div.current`).hide();
                var route = $(`input#search`).data('route');
                var data = { keywords: searchTerm };
                $.ajax({
                    url: route,
                    type: 'get',
                    data: data,
                    success: function (response) {
                        $(`div.search`).remove();
                        $(`div#all-tasks`).children('div').append(response.all);
                        $(`div#pending`).children('div').append(response.off);
                        $(`div#completed`).children('div').append(response.on);
                        $(`.btnDelete`).click(deleteFunction);
                    },
                    error: function (error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            var errors = error.responseJSON.errors;
                            console.log("Lỗi cụ thể:");
                            console.log(errors);
                        }
                    }
                })
            } else {
                $(`div.search`).remove()
                $(`div.current`).show();
            }
        }, 500); // Đợi 0.5 giây trước khi thực hiện tìm kiếm
    });

    $(`button.btnDelete`).click(deleteFunction);


});
// function xử lý xoá (dùng chung)
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

