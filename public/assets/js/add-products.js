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
});