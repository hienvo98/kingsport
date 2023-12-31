$(document).ready(function () {
    $("#product-category-add").trigger("change");
    let regular_price = $(`input[name=regular_price]`).val();
    let format_number_regular = regular_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $(`input[name=regular_price]`).next().text(format_number_regular + " " + 'Đồng');
    let sale_price = $(`input[name=sale_price]`).val();
    let format_number_sale = sale_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $("input[name='sale_price']").next().text(format_number_sale.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " Đồng");
    let discount = $(`input[name=discount]`).val();
    $(`input[name=discount]`).next().text("Giảm giá " + discount + "%");
    $(`input[name=discount]`).prop('disabled',false);
    let pathAvatar = $(`input[name=avatarThumb]`).data('pathavatar');
    $(`div[data-slide=avatar]`).append(` <div class="swiper-slide" style="position:relative">
    <img class="img-fluid thumbnail" data-num="" src="${pathAvatar}" alt="img">
</div>`)
    let pathColor = $(`input[name=avatarThumb]`).data('pathcolor');
    let num_color = $(`input[name=avatarThumb]`).data('num-color');
    for (let i = 1; i <= num_color; i++) {
        $(`div#addImage`).click();
        $(`a[data-group-color]`).first().remove();
        $(`input#file-color-${i}`).prop('required', false);
        $(`select[data-select-color=color-${i}]`).val($(`input[name=avatarThumb]`).data(`color-${i}`));
        $(`select.select-color`).trigger('change');
        $(`div[data-slide=color-${i}]`).append($(`input[name=avatarThumb]`).data(`image-${i}`));
    }

    $(`form#form-product-edit`).submit(function (e) {
        e.preventDefault();
        $(`div#errors`).empty();
        var formData = new FormData(this);
        const quillContent = quill.root.innerHTML;
        formData.append('desc', quillContent); 
        var id = $(`input[name=product_id]`).val();
        var route = $(`input[name=route]`).val();
        $.ajax({
            url: route,
            type: 'post',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                $('#success').click();
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