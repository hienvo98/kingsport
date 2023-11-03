$(document).ready(function () {

    $("#openCreateModal").click(function () {
        $(`form#tagForm`)[0].reset();
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
    $(`select`).val($(this).data('status'));
    $(`select`).change();
    $(`#tagName`).val($(this).data('name'));
    $(`input[name=url]`).val($(this).data('url'));
    $(`input[name=seo_title]`).val($(this).data('seo-title'));
    $(`input[name=seo_keywords]`).val($(this).data('seo-keywords'));
    $(`textarea[name=seo_description]`).text($(this).data('seo-description'));
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