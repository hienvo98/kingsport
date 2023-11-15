$(document).ready(function () {
    $("div#subcategory_box").hide();

    $("#product-category-add").change(function () {
        $(`div.open-sub`).addClass('d-none');
        $(`div.open-sub`).removeClass("open-sub");
        $("div#subcategory_box").hide();
        var selectedCategory = $(this).val();
        if (selectedCategory) {
            var url = "/admin/category/get-subcategories/" + selectedCategory;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    $(`div[data-parent-id=${selectedCategory}]`).removeClass('d-none');
                    $(`div[data-parent-id=${selectedCategory}]`).addClass('open-sub');
                    $("div#subcategory_box").slideDown();
                },
                error: function () {
                }
            });
        } else {
            var selectBox = $("div.options-list");
            selectBox.empty();
            selectBox.append($('p', {
                value: '',
                text: 'Select a category first'
            }));
        }
    });

    $("input[name='regular_price']").keyup(function () {
        let regular_price = $(this).val();
        let format_number = regular_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        let discount = $("input[name='discount']").val()
        if (regular_price == '') {
            $("input[name='discount']").prop('disabled', true);
            $(this).next().text('');
            $("input[name='sale_price']").val('');
            $("input[name='sale_price']").next().text('');
        } else {
            $("input[name='discount']").prop('disabled', false);
            $(this).next().text(format_number + " " + 'Đồng');
            if (discount) {
                $("input[name='sale_price']").val(regular_price - (regular_price * discount) / 100);
                $("input[name='sale_price']").next().text((regular_price - (regular_price * discount) / 100).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng");
            } else {
                $("input[name='sale_price']").val(regular_price);
                $("input[name='sale_price']").next().text(regular_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng");
            }
        }
    })

    $("input[name='discount']").keyup(function () {
        let discount = $(this).val();
        let regular_price = $("input[name='regular_price']").val();
        if (discount == '') {
            $("input[name='sale_price']").val(regular_price);
            $(this).next().text('Từ 1-50');
            $("input[name='sale_price']").next().text(regular_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng")
        } else {
            let sale_price = (regular_price * discount) / 100;
            $(this).next().text("Giảm giá " + discount + "%");
            $("input[name='sale_price']").val(regular_price - sale_price);
            $("input[name='sale_price']").next().text((regular_price - sale_price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng");
        }
    })

    var imageIndex = 1;

    $("#notification").fadeIn();

    setTimeout(function () {
        $("#notification").fadeOut();
    }, 5000);

    var stt = 1; //xác định vị trí của colorGroup khi xử lý xoá color group và sau đó thêm lại.
    $(`div#addImage`).click(function () {
        var groupColorNone = $(`div.color-group`).not('.color_group_display').first();
        groupColorNone.addClass('color_group_display');
        groupColorNone.css('order', stt);
        stt++;
        let color_number = groupColorNone.attr('data-group-color');
        $(`select[data-select-color=${color_number}]`).prop('required', true);
        $(`input#file-${color_number}`).prop('required', true);
        if ($(`div.color-group`).not('.color_group_display').length == 0) $(this).slideUp();
        groupColorNone.slideToggle();
    })
    //xoá form ảnh
    $(`a.trash`).click(function () {
        var color_number = $(this).data('group-color');
        var colorGroup = $(`div[data-group-color=${color_number}]`);
        colorGroup.removeClass('color_group_display');
        $(`select[data-number-color=${color_number}]`).val('');
        $(`select.select-color`).trigger('change');
        $(`select[data-select-color=${color_number}]`).prop('required', false);
        $(`input#file-${color_number}`).prop('required', false);
        $(`input#file-${color_number}`).val('');
        $(`div[data-slide=${color_number}]`).empty();
        if ($(`div.color_group_display`).length < 3) $(`div#addImage`).slideDown();
        colorGroup.slideToggle();
    })

    $('input[type="file"]').change(function () {
        var imageList = $(`div#image-container-${$(this).attr('data-color')}`);
        var slide = ``;
        for (var i = 0; i < this.files.length; i++) {
            slide += `<div class="swiper-slide" style="position:relative">
                <img class="img-fluid thumbnail" data-num="${$(this).attr('data-color')}-${i}" src="${URL.createObjectURL(this.files[i])}" alt="img">
            </div>`;
        };
        $(`div[data-slide=${$(this).attr('data-color')}]`).empty();
        $(`div[data-slide=${$(this).attr('data-color')}]`).append(slide); // Thêm slide mới vào cấu trúc DOM
    });

    // xử lý click chọn màu
    $(`select.select-color`).change(function () {
        let color_number = $(this).attr('data-number-color');
        let value = $(this).val();
        $(`input#${color_number}`).val(value);
        $(`input#${color_number}`).prop('checked', true);
        $(`input#file-${color_number}`).attr('name', `image_color[${value}][]`);
        $(`input#file-${color_number}`).attr('data-ver-color', value);
        let currentColor = [];
        $.each($(`input.check-color`), function (index, value) {
            currentColor.push(value.value);
        });
        $.each($(`select.select-color`).not($(this)), function (index, item) {
            let regular_color = ['red', 'black', 'gray', 'white', 'beige', 'brown'];
            let list_option = $(item).find(`option`);
            let color_select = [];
            $.each(list_option, function (index, item) {
                if ($(item).attr('data-color')) color_select.push($(item).attr('data-color'));
            });
            let miss_color = regular_color.filter(item => !color_select.includes(item));
            $.each(miss_color, function (index, value) {
                $(item).append(`<option data-color="${value}" >${value}</option>`)
            });
            let selected_color = currentColor.filter(value => value != $(item).val() && value != '');
            $(item).find(`option[data-color=${selected_color[0]}]`).remove();
            $(item).find(`option[data-color=${selected_color[1]}]`).remove();
        })
    });

    let slugUrl = function (str) {
        // Chuyển hết sang chữ thường
        str = str.toLowerCase();

        // xóa dấu
        str = str
            .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
            .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp

        // Thay ký tự đĐ
        str = str.replace(/[đĐ]/g, 'd');

        // Xóa ký tự đặc biệt
        str = str.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        str = str.replace(/(\s+)/g, '-');

        // Xóa ký tự - liên tiếp
        str = str.replace(/-+/g, '-');

        // xóa phần dư - ở đầu & cuối
        str = str.replace(/^-+|-+$/g, '');

        // return
        return str;
    }

    $(`input[name=name]`).keyup(function () {
        $(`input[name=url]`).val(slugUrl($(this).val()));
    })
    // xử lý dữ liệu trước khi submit form bằng ajax lên server
    $(`form#form-product`).submit(function (e) {
        e.preventDefault();
        $(`div#errors`).empty();
        let formData = new FormData(this)
        const quillContent = quill.root.innerHTML;
        formData.append('desc', quillContent);
        $.ajax({
            url: '/admin/product/store',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.messages) {
                    $('#success').click();
                }
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
                    if (typeError > 0) errorMessages += `<div class="alert alert-danger text-capitalize">
                        Chọn sai định dạng ảnh, ảnh phải có đuôi .jpeg, .png, .webp, .gif hoặc kích thước ảnh quá lớn
                    </div>`
                    $(`div#errors`).append(errorMessages);
                }
            }
        })
    })


    $(`a.btnDeleteProduct`).click(deleteProduct)

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
                        $(`a.btnDeleteProduct`).click(deleteProduct);
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
});

$(`ul.task-main-nav li`).click(function () {
    $(`ul.task-main-nav li`).removeClass('active');
    $(this).addClass('active');
    var newURL = $(this).find('a').data('update-url');
    history.replaceState(null, '', newURL);
    console.log($(this).data('route-filter'));
    $.ajax({
        url: $(this).find('a').data('route-filter'),
        type: 'get',
        success: function (data) {
            $(`tbody`).html(data.html);
            $('ul.pagination').html(data.nav);
            $(`a.btnDeleteProduct`).click(deleteProduct);
        },
        error: function (error) {
            console.log(error);
        }
    })
})

var deleteProduct = function (even) {
    even.preventDefault();
    let id = $(this).data('id');
    $.ajax({
        url: 'delete/' + id,
        type: 'get',
        success: function (response) {
            if (response.messages == 'success') $('#success').click();
        },
        error: function (error) {
            console.log(error)
        }
    })
}
