
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
        var productInArticle = $(`select#choices-multiple-groups`).val();
        formData.append('productInArticle',productInArticle);
        $.ajax({
            type: 'POST',
            url: '/admin/post/store',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                // $('#success').click();
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
        var product_id = $(`select#choices-multiple-groups`).val();
        console.log(product_id);
        // $.ajax({
        //     url: $(this).data('route'),
        //     type: 'post',
        //     data: formData,
        //     processData: false,
        //     contentType: false,
        //     success: function (response) {
        //         $('#success').click();
        //     },
        //     error: function (error) {
        //         if (error.responseJSON && error.responseJSON.errors) {
        //             $("html, body").animate({ scrollTop: 0 }, 'fast')
        //             var errors = error.responseJSON.errors;
        //             console.log("Lỗi cụ thể:");
        //             console.log(errors);
        //             var errorMessages = "";
        //             var typeError = 0;
        //             for (var key in errors) {
        //                 if (errors.hasOwnProperty(key) && key.split('.').length != 3) {
        //                     for (var keyChild of errors[key]) {
        //                         errorMessages += `<div class="alert alert-danger text-capitalize">
        //                             ${keyChild}
        //                         </div>`;
        //                     }
        //                 } else {
        //                     typeError++;
        //                 }
        //             }
        //             $(`div#errors`).append(errorMessages);
        //         }
        //     }
        // })
    })

    var deletePost = function () {
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
    $(`.btnPostDelete`).click(deletePost);

    $(`input#searchPost`).keyup(function () {
        var route = $(this).data('route');
        var keywords = $(this).val();
        var data = { keywords: keywords };
        $.ajax({
            url: route,
            type: 'get',
            data: data,
            success: function (response) {
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

$(`a.list-cat-post`).click(function(){
    var route = $(this).data('route');
    $.ajax({
        url: route,
        type: 'get',
        success:function(response){
            $(`div#all-tasks`).children('div').html(response.blogs);
            $(`div#pending`).children('div').html(response.blogPendings);
            $(`div#completed`).children('div').html(response.blogCompleteds);
            $('nav#nav').html(response.nav);
            $(`.btnPostDelete`).click(deletePost);
        },
        error: function(error){
            if (error.responseJSON && error.responseJSON.errors) {
                var errors = error.responseJSON.errors;
                console.log("Lỗi cụ thể:");
                console.log(errors);
            }
        }
    })
})

// for blog tags
const multipleCancelButton1 = new Choices(
    '#blog-tags',
    {
        allowHTML: true,
        removeItemButton: true,
    }
);