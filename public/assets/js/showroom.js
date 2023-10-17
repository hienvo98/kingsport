$(document).ready(function() {

    const multipleCancelButton1 = new Choices(
        '#blog-tags',
        {
            allowHTML: true,
            removeItemButton: true,
        }
    );
    const $titleInput = $('#blog-title');
    const $urlInput = $('#blog-url');

    $titleInput.on('input', function () {
        const title = $titleInput.val();

        const url = title
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[àáảãạâầấẩẫậăằắẳẵặ]/g, 'a')
            .replace(/[èéẻẽẹêềếểễệ]/g, 'e')
            .replace(/[ìíỉĩị]/g, 'i')
            .replace(/[òóỏõọôồốổỗộơờớởỡợ]/g, 'o')
            .replace(/[ùúủũụưừứửữự]/g, 'u')
            .replace(/[ỳýỷỹỵ]/g, 'y')
            .replace(/đ/g, 'd')
            .replace(/[^a-z0-9-]/g, '-')
            .replace(/--+/g, '-').replace(/^-+|-+$/g, '');
        $urlInput.val(url);
    });

    $('#images_detail').on('change', function(e) {
        var files = e.target.files;
        if (files.length > 11) {
            alert("Chỉ được phép tải lên tối đa 11 ảnh.");
            return;
        }
        $('#image-list').empty();
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.type.match('image.*')) {
                var reader = new FileReader();
                loadImage(
                    file,
                    function (img) {
                        // Khi xử lý xong, img chứa hình ảnh đã thay đổi kích thước
                        // Hiển thị hình ảnh trong danh sách
                        var image = $('<img>').attr('src', img.toDataURL('image/jpeg'));
                        $('#image-list').append(image);
                    },
                    { maxWidth: 150, maxHeight: 150, canvas: true, orientation: true }
                );
            }
        }
    });


    $('#showroom-form').submit(function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const quill = new Quill('#blog-content', {
            theme: 'snow'
        });
        const quillContent = quill.root.innerHTML;
        formData.append('blog_content', quillContent);
        // console.log(quillContent);
        $.ajax({
            type: 'POST',
            url: '/admin/showroom/store',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
                window.scrollTo(0, 0);
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    location.reload();
                }, 3000);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});
