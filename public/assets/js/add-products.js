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

    // $('input[type="file"]').change(function () {
    //     var imageList = $(`div#image-container-${$(this).attr('data-color')}`);
    //     console.log($(this).attr('data-color'));
    //     imageList.empty();

    //     for (var i = 0; i < this.files.length; i++) {
    //         var image = $('<img>');
    //         image.attr('src', URL.createObjectURL(this.files[i]));
    //         image.attr('width', 100);
    //         image.attr('padding',5);
    //         image.addClass('thumbnail');
    //         imageList.append(image);
    //     }

    //     $('.thumbnail').click(function () {
    //         var modal = $('#imageModal');
    //         var modalImage = $('#modalImage');
    //         modalImage.attr('src', $(this).attr('src'));
    //         modal.css('display', 'block');
    //     });

    //     $('.close').click(function () {
    //         $('#imageModal').css('display', 'none');
    //     });
        
    //     $('#imageModal').click(function (e) {
    //         if (e.target === this) {
    //             $(this).css('display', 'none');
    //         }
    //     });
    // });

    var imageIndex = 1;

    $("#notification").fadeIn();

    setTimeout(function () {
        $("#notification").fadeOut();
    }, 5000);


    $(`div#addImage`).click(function () {
        //mã màu mặc định
        let colors = ['red', 'black', 'gray', 'white', 'beige', 'brown'];
        //lấy danh sách mã màu đã được chọn
        let oldColors = $('input.check-color');
        let listOldColor = [];
        if (oldColors) {
            $.each(oldColors, function (index, value) {
                listOldColor.push(value.value);
            })
            //lấy danh sách mã màu còn lại
            let newlistColor = colors.filter(item => !listOldColor.includes(item));
            colors = newlistColor;
        }
        //lấy số lượng form upload và chọn màu ảnh
        let num_color = $('div.color-group').length + 1;
        let options = '';
        //tạo form upload
        $.each(colors, function (index, value) {
            options += `<option data-color="${value}" >${value}</option>`
        })
        let html = `<div class="color-group" style="display:none">
            <div class="col-xl-6">
                <select class="form-select select-color" data-number-color="color-${num_color}" aria-label="Default select example">
                <option selected>Chọn Màu Sản Phẩm</option>
                ${options}
                </select>
            </div>
            <div class="image mt-1" style="border-bottom:1px solid blueviolet">
                <div class="form-check d-none">
                    <div class="card custom-card mb-1">
                        <div class="card-header d-block">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="me-2">
                                    <span>
                                        <div class="form-check-inline">
                                            <input type="checkbox" data-type=""
                                                class="form-check-input check-color" 
                                                id="color-${num_color}" name="color[]"
                                                value="" >
                                        </div>
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <a href="javascript:void(0)">
                                        <label for=""
                                            class="fs-14 fw-semibold text-center"></label>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-box-red mt-1">
                    <div class="col-xl-12 product-documents-container p-2">
                        <p class="fw-semibold mb-2 fs-14">Chọn file ảnh: </p>
                        <input type="file" data-color="color-${num_color}" id="file-color-${num_color}" name=""
                            class="product-Images form-control" name="filepond"
                            multiple data-allow-reorder="true"
                            data-max-file-size="3MB" data-max-files="6">
                    </div>
                    <div class="col-xl-12 product-documents-container p-2">
                        <p class="fw-semibold mb-2 fs-14">Danh sách ảnh:</p>
                        <div id="image-container-color-${num_color}">

                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $(html).insertBefore($(this));
        $(this).prev().slideToggle();
        //xử lý khi chọn màu
        $(`select.select-color`).change(function () {
            let color_number = $(this).attr('data-number-color');
            let value = $(this).val()
            $(`input#${color_number}`).val(value);
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
                console.log(miss_color);
                $.each(miss_color, function (index, value) {
                    $(item).append(`<option data-color="${value}" >${value}</option>`)
                });
                let selected_color = currentColor.filter(value => value != $(item).val() && value != '');
                $(item).find(`option[data-color=${selected_color[0]}]`).remove();
                $(item).find(`option[data-color=${selected_color[1]}]`).remove();
            })
        })

        $('input[type="file"]').change(function () {
            var imageList = $(`div#image-container-${$(this).attr('data-color')}`);
            console.log($(this).attr('data-color'));
            imageList.empty();
    
            for (var i = 0; i < this.files.length; i++) {
                var image = $('<img>');
                image.attr('src', URL.createObjectURL(this.files[i]));
                image.attr('width', 100);
                image.css('margin',3);
                image.addClass('thumbnail');
                imageList.append(image);
            }
    
            $('.thumbnail').click(function () {
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

        if (num_color == 3) $(this).slideToggle();
    })



});

