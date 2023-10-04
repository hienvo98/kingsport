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

    $("input[name='regular_price']").blur(function () {
        let regular_price = $(this).val();
        let format_number = regular_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        let discount = $("input[name='discount']").val()
        if (regular_price == '') {
            $("input[name='discount']").prop('disabled', true);
            $(this).next().text('');
        } else {
            $("input[name='discount']").prop('disabled', false);
            $(this).next().text(format_number + " " + 'Đồng');
            if (discount) {
                $("input[name='sale_price']").val(regular_price - (regular_price * discount) / 100);
                $("input[name='sale_price']").next().text((regular_price-(regular_price * discount) / 100).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng");
            }
        }
    })

    $("input[name='discount']").blur(function () {
        let discount = $(this).val();
        let regular_price = $("input[name='regular_price']").val();
        if (discount == '') {
            $("input[name='sale_price']").val(regular_price);
            $(this).next().text('');
            $("input[name='sale_price']").next().text(regular_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng")
        } else {
            let sale_price = (regular_price * discount) / 100;
            $(this).next().text("Giảm giá " + discount + "%");
            $("input[name='sale_price']").val(regular_price - sale_price);
            $("input[name='sale_price']").next().text((regular_price - sale_price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng");
        }
    })

    $('input[type="file"]').change(function () {
        var imageList = $('#imageList');
        imageList.empty();

        for (var i = 0; i < this.files.length; i++) {
            var image = $('<img>');
            image.attr('src', URL.createObjectURL(this.files[i]));
            image.attr('width', 100);
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

    var imageIndex = 1;

    $("#notification").fadeIn();

    setTimeout(function () {
        $("#notification").fadeOut();
    }, 5000);




});

