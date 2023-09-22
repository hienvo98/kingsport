{{-- <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
    <div class="card bg-white border-0">
        <div class="alert custom-alert1 alert-primary">
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
            <div class="text-center px-5 pb-0">
                <svg class="custom-alert-icon svg-primary" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
                <h5>Information?</h5>
                <p class="">This alert is created to just show the related information.</p>
                <div class="">
                    <button class="btn btn-sm btn-outline-danger m-1">Decline</button>
                    <button class="btn btn-sm btn-primary m-1">Accept</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="modal fade" id="deleteModalCategory" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Xoá Danh Mục</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                <button style="margin-right:3%;" type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="card bg-white border-0">
                    <div class="alert custom-alert1 alert-primary">
                        {{-- <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button> --}}
                        <div class="text-center px-5 pb-0">
                            <svg class="custom-alert-icon svg-primary" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
                            <h5>Bạn Có Chắc Muốn Xoá Danh Mục Này Không?</h5>
                            {{-- <p class="">This alert is created to just show the related information.</p> --}}
                            <div class="">
                                <button class="btn btn-sm btn-outline-danger m-1" data-bs-dismiss="modal">Huỷ</button>
                                <button class="btn btn-sm btn-primary m-1" data-bs-dismiss="modal" id="deleteCategory" data-category-id="{{ $cate->id }}" >Đồng ý</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>