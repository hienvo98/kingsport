<div class="col-xl-3 d-none" id="successAlertContainer"
    style="
                                position: fixed;
                                z-index: 9999;
                                right: 0;
                                top: 0;
                            ">
    <div class="card border-0">
        <div class="alert alert-solid-secondary border border-secondary mb-0 p-2">
            <div class="d-flex align-items-start">
                <div class="me-2">
                    <svg class="flex-shrink-0 svg-white" xmlns="http://www.w3.org/2000/svg" height="1.5rem"
                        viewBox="0 0 24 24" width="1.5rem" fill="#000000">
                        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"></path>
                        <path
                            d="M16.59 7.58L10 14.17l-3.59-3.58L5 12l5 5 8-8zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z">
                        </path>
                    </svg>
                </div>
                <div class="text-fixed-white w-100">
                    <div class="fw-semibold d-flex justify-content-between">Thành Công<button type="button"
                            class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><i
                                class="bi bi-x"></i></button></div>
                    <div id="notify" class="fs-12 op-8 mb-1">cập nhật thành công</div>
                    <div class="fs-12">
                        <a href="javascript:void(0);" class="text-fixed-white fw-semibold me-2">close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success"></div>

<script>
    $(document).ready(function() {
        $('#success').click(function() {
            $('#imageModal').empty();
            $('#imageModal').append(`<div class="spinner-border text-primary" role="status">
            <span class="sr-only text-white">Loading...</span>
          </div>`);
            $('#imageModal').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center'
            });
            setTimeout(function() {
                $('#imageModal').css('display', 'none');
                $('#imageModal').empty();
                $('div#notify').text('Đã Tải Lên Thành Công');
                $('#successAlertContainer').removeClass('d-none');
                setTimeout(function() {
                    $('#successAlertContainer').addClass('d-none');
                }, 2000);
            }, 1500);
        })
    })
</script>
