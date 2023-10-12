
@extends('layouts.appAdmin')
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Bài viết</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                </ol>
            </nav>
        </div>
    </div>
    @if(session('message'))
        <div id="notification" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <!-- Page Header Close -->
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-body p-0">
                    <div class="p-3 d-grid border-bottom border-block-end-dashed">
                        <button class="btn btn-primary d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#addtask">
                            <i class="ri-add-circle-line fs-16 align-middle me-1"></i>Tạo bài viết
                        </button>
                        <div class="modal fade" id="addtask" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="mail-ComposeLabel">Create Task</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-4">
                                        <div class="row gy-2">
                                            <div class="col-xl-12">
                                                <label for="task-name" class="form-label">Task Name</label>
                                                <input type="text" class="form-control" id="task-name" placeholder="Task Name">
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="form-label">Assigned To</label>
                                                <select class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" multiple>
                                                    <option value="Choice 1" selected>Angelina May</option>
                                                    <option value="Choice 2">Kiara advain</option>
                                                    <option value="Choice 3">Hercules Jhon</option>
                                                    <option value="Choice 4">Mayor Kim</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label">Assigned Date</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                        <input type="text" class="form-control" id="addignedDate" placeholder="Choose date and time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label">Target Date</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                        <input type="text" class="form-control" id="targetDate" placeholder="Choose date and time">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="form-label">Priority</label>
                                                <select class="form-control" data-trigger name="choices-single-default" id="choices-single-default">
                                                    <option value="">Select</option>
                                                    <option value="Critical">Critical</option>
                                                    <option value="High">High</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Low">Low</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-bottom border-block-end-dashed">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0" placeholder="Search Task Here" aria-describedby="button-addon2">
                            <button class="btn btn-light" type="button" id="button-addon2"><i class="ri-search-line text-muted"></i></button>
                        </div>
                    </div>
                    <div class="p-3 task-navigation border-bottom border-block-end-dashed">
                        <ul class="list-unstyled task-main-nav mb-0">
                            <li class="px-0 pt-0">
                                <span class="fs-11 text-muted op-7 fw-semibold">TASKS</span>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0);">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-task-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            All Tasks
                                        </span>
                                        <span class="badge bg-success-transparent rounded-pill">167</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-star-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            Starred
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-delete-bin-5-line align-middle fs-14"></i>
                                        </span>
                                        <span class="flex-fill text-nowrap">
                                            Trash
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li class="px-0 pt-2">
                                <span class="fs-11 text-muted op-7 fw-semibold">Danh mục</span>
                            </li>
                            @foreach ($category as $_category)
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2 lh-1">
                                            <i class="ri-price-tag-line align-middle fs-14 fw-semibold text-primary"></i>
                                        </span>
                                        
                                        <span class="flex-fill text-nowrap">
                                            {{$_category->name}}
                                        </span>
                                        
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body p-0">
                            <div class="d-flex p-3 align-items-center justify-content-between">
                                <div>
                                    <h6 class="fw-semibold mb-0">Bài viết</h6>
                                </div>
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                                        <li class="nav-item m-1">
                                            <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#all-tasks" aria-selected="true">Tất Cả</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#pending" aria-selected="true">Chưa xuất bản</a>
                                        </li>
                                        <li class="nav-item m-1">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                            href="#completed" aria-selected="true">Đã xuất bản</a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-sm btn-light btn-wave waves-light waves-effect" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">Select All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Share All</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Delete All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content task-tabs-container">
                    <div class="tab-pane show active p-0" id="all-tasks"role="tabpanel">                     
                        <div class="row" id="tasks-container">
                        @foreach ($blog as $blogAll)
                            <div class="col-xl-4 task-card">
                                <div class="card custom-card <?php if ($blogAll->status == 'off') { echo 'task-pending-card'; } else { echo 'task-completed-card'; } ?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>{{$blogAll->title}}</p>
                                                <p class="mb-3">Ngày tạo : <span class="fs-12 mb-1 text-muted">{{$blogAll->created_at}}</span></p>
                                                <p class="mb-3">Ngày xuất bản : <span class="fs-12 mb-1 text-muted">{{$blogAll->created_at}}</span></p>
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
                        @endforeach
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
                                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>New Project Blueprint</p>
                                                <p class="mb-3">Assigned On : <span class="fs-12 mb-1 text-muted">13,Nov 2022</span></p>
                                                <p class="mb-3">Target Date : <span class="fs-12 mb-1 text-muted">20,Nov 2022</span></p>
                                                <p class="mb-0">Assigned To :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/2.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/8.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/2.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/10.jpg" alt="img">
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
                            <div class="col-xl-4">
                                <div class="card custom-card task-pending-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center">
                                                    <a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 me-1 text-warning"></i></a>Updating Old Ui</p>
                                                <p class="mb-3">Assigned On : <span class="fs-12 mb-1 text-muted">30,Nov 2022</span></p>
                                                <p class="mb-3">Target Date : <span class="fs-12 mb-1 text-muted">05,Dec 2022</span></p>
                                                <p class="mb-0">Assigned To :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/14.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/13.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/21.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/16.jpg" alt="img">
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
                    <div class="tab-pane p-0" id="completed"
                        role="tabpanel">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card custom-card task-completed-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>New Plugin Development</p>
                                                <p class="mb-3">Assigned On : <span class="fs-12 mb-1 text-muted">28,Oct 2022</span></p>
                                                <p class="mb-3">Target Date : <span class="fs-12 mb-1 text-muted">28,Nov 2022</span></p>
                                                <p class="mb-0">Assigned To :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/3.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/8.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/9.jpg" alt="img">
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <div class="btn-list">
                                                    <button class="btn btn-sm btn-icon btn-wave btn-primary-light"><i class="ri-edit-line"></i></button>
                                                    <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                                <span class="badge bg-success-transparent d-block">Low</span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card custom-card task-completed-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>Documentation For New Template</p>
                                                <p class="mb-3">Assigned On : <span class="fs-12 mb-1 text-muted">25,Nov 2022</span></p>
                                                <p class="mb-3">Target Date : <span class="fs-12 mb-1 text-muted">10,Dec 2022</span></p>
                                                <p class="mb-0">Assigned To :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/8.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/10.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/11.jpg" alt="img">
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <div class="btn-list">
                                                    <button class="btn btn-sm btn-icon btn-wave btn-primary-light"><i class="ri-edit-line"></i></button>
                                                    <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                                <span class="badge bg-danger-transparent d-block">Critical</span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card custom-card task-completed-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center">
                                                    <a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>Developing New Events in Plugin</p>
                                                <p class="mb-3">Assigned On : <span class="fs-12 mb-1 text-muted">5,Dec 2022</span></p>
                                                <p class="mb-3">Target Date : <span class="fs-12 mb-1 text-muted">10,Dec 2022</span></p>
                                                <p class="mb-0">Assigned To :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/5.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/8.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/11.jpg" alt="img">
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <div class="btn-list">
                                                    <button class="btn btn-sm btn-icon btn-wave btn-primary-light"><i class="ri-edit-line"></i></button>
                                                    <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                                <span class="badge bg-primary-transparent d-block">Medium</span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card custom-card task-completed-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center"><a href="javascript:void(0);"><i class="ri-star-s-fill fs-16 op-5 me-1 text-muted"></i></a>Designing Of New Ecommerce Pages</p>
                                                <p class="mb-3">Assigned On : <span class="fs-12 mb-1 text-muted">1,Dec 2022</span></p>
                                                <p class="mb-3">Target Date : <span class="fs-12 mb-1 text-muted">15,Dec 2022</span></p>
                                                <p class="mb-0">Assigned To :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/1.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/3.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="../assets/images/faces/6.jpg" alt="img">
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <div class="btn-list">
                                                    <button class="btn btn-sm btn-icon btn-wave btn-primary-light"><i class="ri-edit-line"></i></button>
                                                    <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                                <span class="badge bg-success-transparent d-block">Low</span>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>        
            </div>
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">Next</a>
                </li>
            </ul>
        </div>
    </div>
    <!--End::row-1 -->
    @endsection