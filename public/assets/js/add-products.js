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

    // const mySwiper = new Swiper(".swiper-container", {
    //     direction: "horizontal", // Thiết lập swiper theo chiều ngang
    //     slidesPerView: 1, // Chỉ hiển thị một slide cùng một lúc
    //     autoplay: true, // Bật chế độ tự động phát swiper với thời gian trễ 3000 mili giây
    //     mode: "fade", // Sử dụng chế độ fade
    // });

    $(`div#addImage`).click(function () {
        let num = $("div.color_group_display").length;
        let color_number = `color-${num + 1}`;
        $(`div[data-group-color=${color_number}]`).addClass('color_group_display');
        $(`div[data-group-color=${color_number}]`).slideToggle();
        // //xử lý khi chọn màu
        $(`select.select-color`).change(selectColorEvent);

        if (num + 1 == 3) $(this).slideToggle();
    })

    $('input[type="file"]').change(function () {
        var imageList = $(`div#image-container-${$(this).attr('data-color')}`);
        let slide = ``;
        for (var i = 0; i < this.files.length; i++) {
            // image_color_1.push(this.files[i]);
            slide += `<div class="swiper-slide" style="position:relative">
                <img class="img-fluid thumbnail" data-num="${$(this).attr('data-color')}-${i}" src="${URL.createObjectURL(this.files[i])}" alt="img">
                <i class="bx bx-x delete-image-product" data-num="${$(this).attr('data-color')}-${i}"></i>
            </div>`;
        };
        $(`div[data-slide=${$(this).attr('data-color')}]`).empty();
        $(`div[data-slide=${$(this).attr('data-color')}]`).append(slide); // Thêm slide mới vào cấu trúc DOM
    
        //xử lý xoá ảnh 
        $(`i.delete-image-product`).click(function () {
            let data_num = $(this).attr('data-num');
            
        })


        $('img.thumbnail').click(function () {
            var modal = $('#imageModal');
            var modalImage = $('#modalImage');
            modalImage.attr('src', $(this).attr('src'));
            modal.css('display', 'block');
        });

        $('.close').click(function () {
            $('#imageModal').css('display', 'none');
        });

        $('#imageModal').click(function (e) {
            if (e.target === this) {
                $(this).css('display', 'none');
            }
        });
    });



    let selectColorEvent = function () {
        let color_number = $(this).attr('data-number-color');
        let value = $(this).val()
        $(`input#${color_number}`).val(value);
        $(`input#${color_number}`).prop('checked', true);
        $(`input#file-${color_number}`).attr('name', `image_color[${value}][]`);
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

    $(`button[type=submit]`).click(function (event) {
        // event.preventDefault();
        // let oldForm = $('form#form-product');
        // let form = document.getElementById("form-product");
        // let formData = new FormData();
        // formData.append('files[]', 'okokokokok');
        // formData.append('files[]', 'hehehehe');
        // $.ajax({
        //     url: '/admin/product/store',
        //     method: 'post',
        //     data: formData,
        //     processData: false,
        //     contentType: false,
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     success: function (data) {
        //         console.log(data);
        //     },
        //     error: function (error) {
        //         console.log(error);
        //     }
        // })
        // console.log(formData.get('files[]'));
        // console.log(test);

    })
});

