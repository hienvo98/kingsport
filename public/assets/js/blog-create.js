(function () {
    "use strict"

    // for blog content
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'font': [] }],
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'align': [] }],

        ['image', 'video'],
        ['clean']                                         // remove formatting button
    ];
    var quill = new Quill('#blog-content', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    // for blog images
    const MultipleElement = document.querySelector('.blog-images');
    FilePond.create(MultipleElement,);
    
    // for publish date picker
    flatpickr("#publish-date", {});

    // for publish time
    flatpickr("#publish-time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    // for blog tags
    const multipleCancelButton1 = new Choices(
        '#blog-tags',
        {
            allowHTML: true,
            removeItemButton: true,
        }
    );

})();

$(document).ready(function() {
    const $titleInput = $('#blog-title');
    const $urlInput = $('#blog-url');

    $titleInput.on('input', function() {
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

    $('#blog-form').submit(function(event) {
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
            url: '/admin/post/store', 
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // console.log(response);
                window.scrollTo(0, 0);
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                    location.reload();
                }, 3000);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

});