<div class="tab-content task-tabs-container">
    <div class="tab-pane show active p-0" id="all-tasks"role="tabpanel">                     
        <div class="row" id="tasks-container">
        
            <div class="col-xl-4 task-card">
                @foreach($showrooms as $all)
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <div>
                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>{{$all->name}}</p>
                                <p class="mb-3">Địa chỉ : <span class="fs-12 mb-1 text-muted">{{$all->address}}</span></p>
                                <p class="mb-3">Số điện thoại : <span class="fs-12 mb-1 text-muted">{{$all->phone}}</span></p>
                                
                                </p>
                            </div>                        
                        </div> 
                    </div>
                </div>
            </div>
        
        </div>                        
    </div>
    <div class="tab-pane p-0" id="pending"
        role="tabpanel">
        <div class="row">         
            <div class="col-xl-4">
                <div class="card custom-card task-pending-card">
                <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <div>
                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a></p>
                                <p class="mb-3">Ngày tạo : <span class="fs-12 mb-1 text-muted"></span></p>
                                <p class="mb-3">Ngày xuất bản : <span class="fs-12 mb-1 text-muted"></span></p>
                                <p class="mb-0">Người tạo :
                                    <span class="avatar-list-stacked ms-1">
                                        <span class="avatar avatar-sm avatar-rounded">
                                            <img src="../assets/images/faces/2.jpg" alt="img">
                                        </span>
                                    </span>
                                </p>
                            </div>
                            
                        </div> 
                    </div>
                </div>
            </div>           
        </div>
    </div>
    <div class="tab-pane p-0" id="completed"
        role="tabpanel">
        <div class="row">
        
            <div class="col-xl-4">
                <div class="card custom-card task-pending-card">
                <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <div>
                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a></p>
                                <p class="mb-3">Ngày tạo : <span class="fs-12 mb-1 text-muted"></span></p>
                                <p class="mb-3">Ngày xuất bản : <span class="fs-12 mb-1 text-muted"></span></p>
                                <p class="mb-0">Người tạo :
                                    <span class="avatar-list-stacked ms-1">
                                        <span class="avatar avatar-sm avatar-rounded">
                                            <img src="../assets/images/faces/2.jpg" alt="img">
                                        </span>
                                    </span>
                                </p>
                            </div>
                            <div>
                                <div class="btn-list">
                                    <button class="btn btn-sm btn-icon btn-wave btn-primary-light"><i class="ri-edit-line"></i></button>
                                    <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0"><i class="ri-delete-bin-line"></i></button>
                                </div>
                                <span class="badge bg-warning-transparent d-block">High</span>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        
        </div>    
    </div>
</div>        