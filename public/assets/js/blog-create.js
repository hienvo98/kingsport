
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

    $('#blog-form').submit(function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const quillContent = quill.root.innerHTML;
        formData.append('description', quillContent);
        $.ajax({
            type: 'POST',
            url: '/admin/post/store',
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

    $(`input[type=file]`).change(function () {
        $('img#thumbnailImg').attr('src', URL.createObjectURL(this.files[0]));
    })

    $(`form#blog-form-update`).submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        // var quillContent = quill.root.innerHTML;
        formData.append('content', quill.root.innerHTML);
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
        console.log(quillContent);
        console.log(formData);
    })

    var deletePost = function () {
        let id = $(this).data('id');
        $.ajax({
            url: 'delete/' + id,
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
    $(`.btnPostDelete`).click(deletePost);
    $(`input#searchPost`).keyup(function () {
        let keywords = $(this).val();
        let data = { keywords: keywords };
        $.ajax({
            url: 'search',
            type: 'get',
            data: data,
            success: function (response) {
                // let blog = response.blog.data.map(function(blog){
                //     return blog.title;
                // })
                $(`div#all-tasks`).children('div').empty();
                $(`div#all-tasks`).children('div').html(response.blogs);
                $(`div#pending`).children('div').html(response.blogPendings);
                $(`div#completed`).children('div').html(response.blogCompleteds);
                $(`.btnPostDelete`).click(deletePost);
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
});
// for blog tags
const multipleCancelButton1 = new Choices(
    '#blog-tags',
    {
        allowHTML: true,
        removeItemButton: true,
    }
);