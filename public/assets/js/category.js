$(document).ready(function () {

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
                    $('#categories_status option[value=true]').prop('selected', true);
                } else {
                    $('#categories_status option[value=false]').prop('selected', true);
                }
                $('#categories_ordinal_number').val('Danh mục thứ ' + data.data.ordinal_number);
                $('#categories_ordinal_number').prop('disabled',true);
                $('img#imageCatEdit').attr('src',data.pathImage);
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
        var categoryId = $(this).data('category-id');
        $(`form#sub-categoryForm`).append(`<input type="hidden" name="category_id" value="${categoryId}">`)
        $.ajax({
            url: 'category/sub-category/getRank/' + categoryId,
            type: 'get',
            success: function (data) {
                $("#sub_ordinal_number").val(`Danh Mục Thuộc Tính Thứ ${data.messages + 1}`);
                $("#sub_ordinal_number").prop('disabled',true);
                $(`input[name=sub_ordinal_number]`).val(data.messages + 1);
            },
            error: function (error) {
                console.log(error);
            }
        })
        var categoryName = $(this).data('category-name');
        $(`form#sub-categoryForm`).append(`<input type="hidden" name="category_name" value="${categoryName}">`);
        $('#createSubCateModal').modal('show');
        $('#SubCategory_name').val(categoryName);
        $('#SubCategory_name').prop('disabled',true);
        $('.btnAddSubCate').attr('data-id',categoryId);
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

    $('button#delete').click(function () {
        var categoryId = $(this).attr('data-id');
        console.log(categoryId);
        $.ajax({
            url: '/admin/category/delete/' + categoryId,
            type: 'GET',
            success: function (data) {
                // console.log(data);
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

    $(`input[name=avatar]`).change(function(){
        $(this).next().hide();
        $(this).next().attr('src',URL.createObjectURL(this.files[0]));
        $(this).next().show();
    })

    $('.btn-edit-category').click(editModalCategory);

    //save after edit category
    $(`form#editCategoryForm`).submit(function(e){
        e.preventDefault();
        var categoryId = $('#category_id').val();
        var formData = new FormData(this);
        $.ajax({
            url: `category/update/${categoryId}`,
            type: 'post',
            data:formData,
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
    
    $(`form#categoryForm`).submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/admin/category/store',
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                // console.log(response)
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
    $(`form#sub-categoryForm`).submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/admin/category/sub-category/create',
            type:'post',
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

    function showSuccessToast() {
        const successToastElement = document.getElementById('successToast');
        if (successToastElement) {
            const toast = new bootstrap.Toast(successToastElement);
            toast.show();
        }
    }
});