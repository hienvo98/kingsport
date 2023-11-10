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
    $(`input#thumbnail`).change(function(){
        $(`img#thumbnailImg`).attr('src',URL.createObjectURL(this.files[0]));
        $(`img#thumbnailImg`).show();
    })

    $("#openCreateModal").click(function () {
        $(`form#tagForm`)[0].reset();
        $(`input[name=imageThumb]`).prop('required',true);
        $(`img#thumbnailImg`).val('');
        $(`img#thumbnailImg`).hide();
        $(`form#tagForm`).attr('data-route', $(this).data('route'));
        $("#createModal").modal("show");
    });

    $(`form#tagForm`).submit(function (e) {
        e.preventDefault();
        var route = $(this).data('route');
        var formData = new FormData(this);
        $.ajax({
            url: route,
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                $("#createModal").modal("hide");
                $(`#success`).click();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(`a.btn-edit`).click(editTag);

    $(`a.btn-delete`).click(deleteTag);

    //xử lý tìm kiếm jax (dùng chung)
    var debounceTimer;
    $(`input#search`).on('input', function () {
        clearTimeout(debounceTimer); // Xóa bất kỳ hẹn giờ nào còn tồn tại

        debounceTimer = setTimeout(function () {
            // Thực hiện tìm kiếm ở đây sau khi người dùng ngưng gõ trong 0.5 giây
            var searchTerm = $(`input#search`).val();
            if (searchTerm.trim() !== '') {
                $(`tr.current`).hide();
                var route = $(`input#search`).data('route');
                var data = { keywords: searchTerm };
                $.ajax({
                    url: route,
                    type: 'get',
                    data: data,
                    success: function (response) {
                        $(`tr.search`).remove()
                        $(`tbody`).append(response.html);
                        $(`a.btn-edit`).click(editTag);
                        $(`a.btn-delete`).click(deleteTag);
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
                $(`tr.search`).remove()
                $(`tr.current`).show();
            }
        }, 500); // Đợi 0.5 giây trước khi thực hiện tìm kiếm
    });
});

var editTag = function () {
    $(`form#tagForm`)[0].reset();
    $(`input[name=imageThumb]`).prop('required',false);
    $(`select`).val($(this).data('status'));
    $(`select`).change();
    $(`#blog-title`).val($(this).data('name'));
    $(`#blog-url`).val($(this).data('url'));
    $(`input[name=url]`).val($(this).data('url'));
    $(`input[name=seo_title]`).val($(this).data('seo-title'));
    $(`input[name=seo_keywords]`).val($(this).data('seo-keywords'));
    $(`textarea[name=seo_description]`).text($(this).data('seo-description'));
    $(`img#thumbnailImg`).attr('src',$(this).data('image'));
    $(`img#thumbnailImg`).show();
    $(`form#tagForm`).attr('data-route', $(this).data('route'));
    $("#createModal").modal("show");
};

var deleteTag = function () {
    var route = $(this).data('route');
    $.ajax({
        url: route,
        type: 'get',
        success: function (response) {
            $(`#success`).click();
        },
        error: function (error) {
            console.log(error);
        }
    });
}