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


    $(`div#addImage`).click(function () {
        let num = $("div.color_group_display").length;
        let color_number = `color-${num + 1}`;
        $(`div[data-group-color=${color_number}]`).addClass('color_group_display');
        $(`div[data-group-color=${color_number}]`).slideToggle();
        // //xử lý khi chọn màu
        $(`select[data-select-color=${color_number}]`).prop('required', true);
        $(`input#file-${color_number}`).prop('required', true);
        $(`select.select-color`).change(selectColorEvent);

        if (num + 1 == 3) $(this).slideToggle();
    })

    $('input[type="file"]').change(function () {
        var imageList = $(`div#image-container-${$(this).attr('data-color')}`);
        let slide = ``;
        for (var i = 0; i < this.files.length; i++) {
            slide += `<div class="swiper-slide" style="position:relative">
                <img class="img-fluid thumbnail" data-num="${$(this).attr('data-color')}-${i}" src="${URL.createObjectURL(this.files[i])}" alt="img">
            </div>`;
        };
        $(`div[data-slide=${$(this).attr('data-color')}]`).empty();
        $(`div[data-slide=${$(this).attr('data-color')}]`).append(slide); // Thêm slide mới vào cấu trúc DOM
    });

    // xử lý click chọn màu
    let selectColorEvent = function () {
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
    }

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
        let formData = new FormData()
        let listSubCat = $(`input[data-type='subCat']`);
        for (var i = 0; i < listSubCat.length; i++) {
            var checkbox = $(`input[data-stt=sub-${i}]`);
            // Kiểm tra xem checkbox có được checked không
            if (checkbox.is(':checked')) {
                // Nếu được checked, thêm giá trị của checkbox vào FormData object
                formData.append('subCat[]', checkbox.val());
            }
        }
        for (let i = 1; i <= 3; i++) {
            // Lấy danh sách các tệp tin từ input file
            let files = $("input#file-color-" + i).prop("files");
            let color = $("input#file-color-" + i).attr('data-ver-color');
            // Thêm từng tệp tin vào đối tượng FormData
            if ($("input#file-color-" + i).attr('name')) {
                for (let j = 0; j < files.length; j++) {
                    formData.append(`image_color[${color}][]`, files[j]);
                }
            }
        }
        let listColor = $(`input.check-color`);
        for (let i = 1; i <= listColor.length; i++) {
            if ($(`input#color-${i}`).val()) formData.append('color[]', $(`input#color-${i}`).val());
        }
        formData.append('avatarThumb', $(`input[name=avatar]`).prop('files')[0]);
        formData.append('name', $(`input#product-name-add`).val());
        formData.append('url', $(`input[name=url]`).val())
        formData.append('category_id', $('select#product-category-add').val());
        formData.append('regular_price', $(`input[name=regular_price]`).val());
        formData.append('discount', $(`input[name=discount]`).val());
        formData.append('sale_price', $(`input[name=sale_price]`).val());
        formData.append('quantity', $(`input[name=quantity]`).val());
        formData.append('sold', $(`input[name=sold]`).val());
        formData.append('sorting', $(`input[name=sorting]`).val());
        $(`input[name=on_outstanding]`).is(':checked') ? formData.append('on_outstanding', $(`input[name=on_outstanding]`).val()) : '';
        $(`input[name=on_hot]`).is(':checked') ? formData.append('on_hot', $(`input[name=on_hot]`).val()) : '';
        $(`input[name=on_sale]`).is(':checked') ? formData.append('on_sale', $(`input[name=on_sale]`).val()) : '';
        $(`input[name=on_installment]`).is(':checked') ? formData.append('on_installment', $(`input[name=on_installment]`).val()) : '';
        $(`input[name=on_new]`).is(':checked') ? formData.append('on_new', $(`input[name=on_new]`).val()) : '';
        $(`input[name=on_comming]`).is(':checked') ? formData.append('on_comming', $(`input[name=on_comming]`).val()) : '';
        $(`input[name=on_gift]`).is(':checked') ? formData.append('on_gift', $(`input[name=on_gift]`).val()) : '';
        formData.append('status', $(`select[name=status]`).val());
        formData.append('status_stock', $(`select[name=status_stock]`).val());

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
});

