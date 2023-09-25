
$(document).ready(function () {

    let deleteModalCategory = function () {
        var categoryId = $(this).data('category-id');
        $('button#deleteCategory').attr('data-id', categoryId);
        $("#deleteModalCategory").modal("show");
    }
    let editModalCategory = function () {
        var categoryId = $(this).data('category-id');
        $.ajax({
            url: '/admin/category/edit/' + categoryId,
            type: 'GET',
            success: function (data) {
                $('#categories_name').val(data.data.name);
                if (data.data.status === 1) {
                    $('#categories_status option[value=true]').prop('selected', true);
                } else {
                    $('#categories_status option[value=false]').prop('selected', true);
                }
                $('#categories_ordinal_number').val(data.data.ordinal_number);
                $('#category_id').val(data.data.id);
                $('#editModal').modal('show');
            },

            error: function (xhr, textStatus, errorThrown) {
            }
        });
    }
    let addSubmodalCategory = function () {
        var categoryName = $(this).data('category-name');
        var categoryId = $(this).data('category-id');
        $('#createSubCateModal').modal('show');
        $('#SubCategory_name').val(categoryName);
    }

    $("#openCreateModal").click(function () {
        $("#createModal").modal("show");
    });

    $("input[type='search']").keyup(function (e) {
        let type = $(this).data('type-name');
        let keyword = this.value;
        let data = {
            type: type,
            keyword: keyword
        };
        $.ajax({
            type: 'get',
            url: '/admin/category/search',
            data: data,
            success: function (data) {
                $('tbody#type').html(data.data);
                $("a.deleteModalCategoryOpen").click(deleteModalCategory);
                $('.btn-edit-category').click(editModalCategory);
                $('.subcategory').click(addSubmodalCategory);
            },
            error: function (error) {
                console.log(error);
            }
        })
    });

    $("a.deleteModalCategoryOpen").click(deleteModalCategory);

    $('button#deleteCategory').click(function () {
        var categoryId = $(this).attr('data-id');
        $.ajax({
            url: '/admin/category/delete/' + categoryId,
            type: 'GET',
            success: function (data) {
                $('span#statusCategory-' + categoryId).text('Đã Tắt');
                $('span#statusCategory-' + categoryId).removeClass('bg-success');
                $('span#statusCategory-' + categoryId).addClass('bg-danger');
                $("a#cat-"+categoryId).addClass('disable-link');
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    // location.reload();
                }, 2000);
            },
            error: function (xhr, textStatus, errorThrown) {
            }
        });
    });

    $('.btn-edit-category').click(editModalCategory);

    //save data

    $('#saveChangesBtn').click(function () {
        var formData = $('#editCategoryForm').serialize();
        var categoryId = $('#category_id').val();
        $.ajax({
            type: 'POST',
            url: '/admin/category/update/' + categoryId,
            data: formData,
            success: function (data) {
                $('#categories_name').val(data.data.name);
                if (data.data.status === 1) {
                    $('#categories_status option[value=true]').prop('selected', true);
                } else {
                    $('#categories_status option[value=false]').prop('selected', true);
                }
                $('#categories_ordinal_number').val(data.data.ordinal_number);

                $('#editModal').modal('hide');

                $('#successAlertContainer').removeClass('d-none');

                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    location.reload();
                }, 2000);

            },
            error: function (error) {
                console.error('Lỗi khi cập nhật:', error);
            }
        });
    });


    $('#btnAddCategory').click(function () {
        var formData = $('#categoryForm').serialize();
        $.ajax({
            type: 'POST',
            url: '/admin/category/store',
            data: formData,
            success: function (response) {
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    location.reload();
                }, 4000);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });


    //subcategory

    $('.subcategory').click(addSubmodalCategory);


    $('#btnAddSubCate').click(function (e) {
        e.preventDefault();
        //var categoryId = $('input[name="categoryId"]').val();
        var categoryId = $('.subcategory').data('category-id');

        var formData = $('#sub-categoryForm').serialize();
        var csrfToken = $('#sub-categoryForm').find('input[name="_token"]').val();
        var requestData = {
            _token: csrfToken,
            formData: formData,
            categoryId: categoryId
        };
        $.ajax({
            type: 'POST',
            url: '/admin/sub-category/create',
            data: requestData,
            success: function (response) {
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    location.reload();
                }, 2000);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    function showSuccessToast() {
        const successToastElement = document.getElementById('successToast');
        if (successToastElement) {
            const toast = new bootstrap.Toast(successToastElement);
            toast.show();
        }
    }
});