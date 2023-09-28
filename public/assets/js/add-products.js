$(document).ready(function() {
    $("#product-category-add").change(function() {
        var selectedCategory = $(this).val();
        if (selectedCategory) {
            var url = "/admin/category/get-subcategories/" + selectedCategory;
    
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // var selectBox = $("#product-subcategory-create");
                    var subcategories = response;
                    var $subcategorySelect = $("#product-subcategory-create");
                    $subcategorySelect.empty();
                    
                    var optionsHTML = '<option value="">Select</option>';
                    $.each(subcategories, function (key, value) {
                        console.log(value.name);
                        optionsHTML += '<option value="' + key + '">' + value.name + '</option>';
                    });
                    $subcategorySelect[0].innerHTML = optionsHTML;
                },
                error: function() {
                    // Xử lý lỗi nếu cần
                }
            });
        } else {
            // Nếu không có danh mục được chọn, bạn có thể xử lý nó tại đây.
            // Ví dụ: xóa tất cả các tùy chọn và hiển thị thông báo.
            var selectBox = $("#product-subcategory-create");
            selectBox.empty(); // Xóa tất cả các option cũ
            selectBox.append($('<option>', {
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
        // Đóng modal khi người dùng nhấn ngoài khung modal
        $('#imageModal').click(function (e) {
            if (e.target === this) {
                $(this).css('display', 'none');
            }
        });
    });
    
    var imageIndex = 1;

    // Sự kiện khi người dùng nhấn nút "Thêm hình ảnh"
    $("#add-image-button").click(function() {
        // Tạo một div để chứa cả trường nhập liệu và trường file input
        var imageDiv = $("<div></div>");

        // Trường nhập liệu cho tên màu sắc
        var colorNameInput = $("<input type='text' name='color_name[" + imageIndex + "]' placeholder='Nhập tên màu sắc'>");

        // Trường file input cho hình ảnh
        var imageInput = $("<input type='file' name='image_color[" + imageIndex + "]' class='product-Images'>");
        imageInput.attr({
            "multiple": true,
            "data-allow-reorder": true,
            "data-max-file-size": "3MB",
            "data-max-files": 6
        });

        // Thêm cả trường nhập liệu và trường file input vào div chứa hình ảnh
        imageDiv.append(colorNameInput);
        imageDiv.append(imageInput);

        // Thêm div chứa hình ảnh vào container
        $("#image-container").append(imageDiv);

        // Tăng chỉ mục của trường hình ảnh cho lần tiếp theo
        imageIndex++;
    });
});