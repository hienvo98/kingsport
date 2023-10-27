
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

    $(`ul.task-main-nav li`).click(function () {
        $(`ul.task-main-nav li`).removeClass('active');
        $(this).addClass('active');
    })

    $('form.form-create').submit(function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const quillContent = quill.root.innerHTML;
        formData.append('description', quillContent);
        var productInArticle = $(`select#choices-multiple-groups`).val();
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
        });
    });

    $(`input.thumbnail`).change(function () {
        $('img#thumbnailImg').attr('src', URL.createObjectURL(this.files[0]));
    })

    $(`form.form-update`).submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const quillContent = quill.root.innerHTML;
        formData.append('content', quillContent);
        var productInArticle = $(`select#choices-multiple-groups`).val();
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
    })

    $(`.btnPostDelete`).click(deleteFunction);

    $(`input#searchPost`).keyup(function () {
        var keywords = $(this).val();
        if (keywords.length > 0) {
            $(`div.current`).hide();
            var route = $(this).data('route');
            var data = { keywords: keywords };
            $.ajax({
                url: route,
                type: 'get',
                data: data,
                success: function (response) {
                    $(`div.search`).remove();
                    $(`div#all-tasks`).children('div').append(response.blogs);
                    $(`div#pending`).children('div').append(response.blogPendings);
                    $(`div#completed`).children('div').append(response.blogCompleteds);
                    $(`.btnPostDelete`).click(deleteFunction);
                },
                error: function (error) {
                    if (error.responseJSON && error.responseJSON.errors) {
                        var errors = error.responseJSON.errors;
                        console.log("Lỗi cụ thể:");
                        console.log(errors);
                    }
                }
            })
        }else{
            $(`div.search`).remove()
            $(`div.current`).show();
        }
    })
});

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
            $(`div#all-tasks`).children('div').html(response.blogs);
            $(`div#pending`).children('div').html(response.blogPendings);
            $(`div#completed`).children('div').html(response.blogCompleteds);
            $(`.btnPostDelete`).click(deleteFunction);
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
// for blog tags
const multipleCancelButton1 = new Choices(
    '#blog-tags',
    {
        allowHTML: true,
        removeItemButton: true,
    }
);