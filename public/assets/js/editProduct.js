$(document).ready(function () {
    $("#product-category-add").trigger("change");
    $("input[name='regular_price']").trigger('keyup');
    $("input[name='discount']").trigger('keyup');
    let pathAvatar = $(`input[name=avatar]`).data('pathavatar');
    $(`div[data-slide=avatar]`).append(` <div class="swiper-slide" style="position:relative">
    <img class="img-fluid thumbnail" data-num="" src="${pathAvatar}" alt="img">
</div>`)
    let pathColor = $(`input[name=avatar]`).data('pathcolor');
    let num_color = $(`input[name=avatar]`).data('num-color');
    for (let i = 1; i <= num_color; i++) {
        $(`div#addImage`).click();
        $(`select[data-select-color=color-${i}]`).prop('required', false);
        $(`input#file-color-${i}`).prop('required', false);
        $(`select[data-select-color=color-${i}]`).val($(`input[name=avatar]`).data(`color-${i}`));
        $(`select.select-color`).trigger('change');
        $(`div[data-slide=color-${i}]`).append($(`input[name=avatar]`).data(`image-${i}`));
    }

    $(`form#form-product-edit`).submit(function (e) {
        e.preventDefault();
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
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        })
    })
});