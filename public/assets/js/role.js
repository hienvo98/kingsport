$(document).ready(function(){
    $('a.openDeleteModal').click(function(){
        let data_id = $(this).attr('data-id');
        $('button#delete').attr('data-id',data_id);
        $('div#deleteModal').modal('show');
    })
    $('button#delete').click(function(){
        let data_id = $(this).attr('data-id');
        $.ajax({
            type:'get',
            url:'/admin/role/delete/'+data_id,
            success:function(data){
                if(data.data === 'ok') $('tr#role-'+data_id).remove();
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function () {
                    $('#successAlertContainer').addClass('d-none');
                }, 2000);
            },
            error:function(error){
                console.log(error);
            }
        })
    })
    $("input[data-check-all=true]").click(function() {
        let dataType = $(this).attr('data-type');
        $(`input[data-type=${dataType}]`).not(this).prop('checked', this.checked);
    })
})