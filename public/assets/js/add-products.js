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
                }
            });
        } else {
            var selectBox = $("#product-subcategory-create");
            selectBox.empty();
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
        $('#imageModal').click(function (e) {
            if (e.target === this) {
                $(this).css('display', 'none');
            }
        });
    });
    
    var imageIndex = 1;

    $("#notification").fadeIn();

    setTimeout(function() {
        $("#notification").fadeOut();
    }, 5000);
});