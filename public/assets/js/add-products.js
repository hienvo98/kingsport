$(document).ready(function () {
    $("#product-category-add").change(function () {
        var selectedCategory = $(this).val();
        if (selectedCategory) {
            var url = "/admin/category/get-subcategories/" + selectedCategory;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    $('div.options-list').empty();
                    $('div.options-list').append(`<div class="option" data-value="">Chọn Danh Mục Thuộc Tính</div>`)
                    $.each(response, function (index, value) {
                        $('div.options-list').append(`<div class="option" data-value="${value.id}">${value.name}</div>`)
                    });
                    // console.log(response);
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

