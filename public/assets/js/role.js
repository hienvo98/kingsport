$(document).ready(function () {
    $('a.openDeleteModal').click(function () {
        let data_id = $(this).attr('data-id');
        $('button#delete').attr('data-id', data_id);
        $('div#deleteModal').modal('show');
    })
    $('button#delete').click(function () {
        let data_id = $(this).attr('data-id');
        $.ajax({
            type: 'get',
            url: '/admin/role/delete/' + data_id,
            success: function (data) {
                if (data.data === 'ok') $('tr#role-' + data_id).remove();
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                }, 2000);
            },
            error: function (error) {
                console.log(error);
            }
        })
    })
    $("input[data-check-all=true]").click(function () {
        let dataType = $(this).attr('data-type');
        $(`input[data-type=${dataType}]`).not(this).prop('checked', this.checked);
    })

    $('div.status').click(function () {
        let id = $(this).attr('data-id');
        let status = $(this).hasClass("on");
        let url = status ? '/admin/delete/' + id : '/admin/restore/' + id;
        $.ajax({
            type: 'get',
            url: url,
            success: function (data) {
                // console.log(data);
            },
            error: function (error) {
                console.log(error);
            }
        });
        $(this).toggleClass(function () {
            if ($(this).is("on")) {
                return "off";
            } else {
                return "on";
            }
        })
        $('a.edit-role-' + id).toggleClass('disable-link');
        $('#successAlertContainer').removeClass('d-none');
        setTimeout(function () {
            $('#successAlertContainer').addClass('d-none');
        }, 2000);
    });

    $("select[name='user']").change(function () {
        let id = $(this).val();
        $.ajax({
            type: 'get',
            url: '/admin/roleUser/search/' + id,
            success: function (data) {
               
            },
            error: function (error) {
                console.log(error);
            }
        })
    })
})