$(document).ready(function () {
    var $titleInput = $('.blog-title');
    $titleInput.keyup(function () {
        const title = $(this).val();
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
        $(this).next().val(url);
    });

    let deleteModalCategory = function () {
        var categoryId = $(this).data('category-id');
        $('button#delete').attr('data-id', categoryId);
        $("#deleteModal").modal("show");
    }

    let editModalCategory = function () {
        var categoryId = $(this).data('category-id');
        $.ajax({
            url: '/admin/category/edit/' + categoryId,
            type: 'GET',
            success: function (data) {
                $('#categories_name').val(data.data.name);
                if (data.data.status === '1') {
                    $('#categories_status option[value=1]').prop('selected', true);
                } else {
                    $('#categories_status option[value=0]').prop('selected', true);
                }
                $('#categories_ordinal_number').val('Danh mục thứ ' + data.data.ordinal_number);
                $('#categories_ordinal_number').prop('disabled', true);
                $('img#imageCatEdit').attr('src', data.pathImage);
                $('img#imageCatEdit').show();
                $('#category_id').val(data.data.id);
                $(`input#editNumber`).val(data.data.ordinal_number);
                $('#editModal').modal('show');
            },

            error: function (xhr, textStatus, errorThrown) {
            }
        });
    }

    let addSubmodalCategory = function () {
        $('img#imageCatEdit').val();
        $('img#imageCatEdit').hide();
        var categoryId = $(this).data('category-id');
        $(`form#sub-categoryForm`).append(`<input type="hidden" name="category_id" value="${categoryId}">`)
        $.ajax({
            url: 'category/sub-category/getRank/' + categoryId,
            type: 'get',
            success: function (data) {
                $("#sub_ordinal_number").val(`Danh Mục Thuộc Tính Thứ ${data.messages + 1}`);
                $("#sub_ordinal_number").prop('disabled', true);
                $(`input[name=ordinal_number]`).val(data.messages + 1);
            },
            error: function (error) {
                console.log(error);
            }
        })
        var categoryName = $(this).data('category-name');
        $(`form#sub-categoryForm`).append(`<input type="hidden" name="parent_name" value="${categoryName}">`);
        $('#createSubCateModal').modal('show');
        $('#SubCategory_name').val(categoryName);
        $('#SubCategory_name').prop('disabled', true);
        $('.btnAddSubCate').attr('data-id', categoryId);
    }

    $("#openCreateModal").click(function () {
        $(`form#categoryForm`)[0].reset();
        $('img#image').hide();
        $("#createModal").modal("show");
    });

    $("a.deleteModalCategoryOpen").click(deleteModalCategory);

    $('button#delete').click(function () {
        var categoryId = $(this).attr('data-id');
        console.log(categoryId);
        $.ajax({
            url: '/admin/category/delete/' + categoryId,
            type: 'GET',
            success: function (data) {
                $(`#success`).click()
            },
            error: function (xhr, textStatus, errorThrown) {
            }
        });
    });

    $(`input[name=avatarThumb]`).change(function () {
        $(this).next().hide();
        $(this).next().attr('src', URL.createObjectURL(this.files[0]));
        $(this).next().show();
    })

    $('.btn-edit-category').click(editModalCategory);

    //save after edit category
    $(`form#editCategoryForm`).submit(function (e) {
        e.preventDefault();
        var categoryId = $('#category_id').val();
        var formData = new FormData(this);
        $.ajax({
            url: `category/update/${categoryId}`,
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#editModal").modal("hide");
                $('#success').click();
            },
            error: function (error) {
                console.log(error);
            }

        })
    })

    $(`form#categoryForm`).submit(function (e) {
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

    //subcategory
    $('.subcategory').click(addSubmodalCategory);
    // lưu subCat
    $(`form#sub-categoryForm`).submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/admin/category/sub-category/create',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                $('#createSubCateModal').modal('hide');
                $('#success').click();
            },
            error: function (error) {
                console.log(error);
            }
        })
    })

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
                        $("a.deleteModalCategoryOpen").click(deleteModalCategory);
                        $('.btn-edit-category').click(editModalCategory);
                        $('.subcategory').click(addSubmodalCategory);
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
                $(`tr.search`).remove();
                $(`tr.current`).show();
            }
        }, 500); // Đợi 0.5 giây trước khi thực hiện tìm kiếm
    });


    function showSuccessToast() {
        const successToastElement = document.getElementById('successToast');
        if (successToastElement) {
            const toast = new bootstrap.Toast(successToastElement);
            toast.show();
        }
    }
});