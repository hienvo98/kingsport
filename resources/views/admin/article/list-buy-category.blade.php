<div class="tab-content task-tabs-container">
    <div class="tab-pane show active p-0" id="all-tasks"role="tabpanel">
        <div class="row" id="tasks-container">
            @if ($blog)
                @foreach ($blog as $blogAll)
                    <div class="col-xl-4 task-card">
                        <div class="card custom-card <?php if ($blogAll->status == 'off') {
                            echo 'task-pending-card';
                        } else {
                            echo 'task-completed-card';
                        } ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div>
                                        <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                                href="javascript:void(0);"></i></a>{{ $blogAll->title  }}
                                        </p>
                                        <p class="mb-3">Ngày tạo : <span
                                                class="fs-12 mb-1 text-muted">{{ $blogAll->created_at }}</span></p>
                                        <p class="mb-3">Ngày xuất bản : <span
                                                class="fs-12 mb-1 text-muted">{{ $blogAll->publish_date }}</span></p>
                                        <p class="mb-3">Người tạo :
                                            <span class="avatar-list-stacked ms-1">
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ url("storage/uploads/blog_images/$blogAll->title/thumbnail/$blogAll->thumbnail") }}"
                                                        alt="img">
                                                </span>
                                            </span>
                                        </p>
                                        @if ($blogAll->status == 'on')
                                            <p class="mb-0">Trạng Thái: <span class="text-primary bg-light">Hiển
                                                    thị</span>
                                            @else
                                            <p class="mb-0">Trạng Thái: <span class="text-danger bg-light">Ẩn</span>
                                        @endif
                                        </p>
                                    </div>
                                    <div>
                                        <div class="btn-list">
                                            <a href="{{ route('admin.post.edit',['id'=>$blogAll->id]) }}"
                                                class="btn btn-icon btn-sm btn-info-light"><i
                                                    class="ri-edit-line"></i></a>
                                            <button
                                                class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete"
                                                data-id="{{ $blogAll->id }}" data-route="{{ url("/admin/post/delete/$blogAll->id") }}"
                                                {{ $blogAll->status == 'off' ? 'disabled' : '' }}><i
                                                    class="ri-delete-bin-line"></i></button>
                                        </div>
                                        {{-- <span class="badge bg-warning-transparent d-block">High</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="tab-pane p-0" id="pending" role="tabpanel">
        <div class="row">
            @foreach ($blogPendings as $blogPending)
                <div class="col-xl-4">
                    <div class="card custom-card task-pending-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div>
                                    <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                            href="javascript:void(0);"></i></a>{{ $blogPending->title }}
                                    </p>
                                    <p class="mb-3">Ngày tạo : <span
                                            class="fs-12 mb-1 text-muted">{{ $blogPending->created_at }}</span></p>
                                    <p class="mb-3">Ngày xuất bản : <span
                                            class="fs-12 mb-1 text-muted">{{ $blogPending->publish_date }}</span></p>
                                    <p class="mb-0">Người tạo :
                                        <span class="avatar-list-stacked ms-1">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ url("storage/uploads/blog_images/$blogPending->title/thumbnail/$blogPending->thumbnail") }}"
                                                    alt="img">
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <div class="btn-list">
                                        <a href="{{ route('admin.post.edit',['id'=>$blogPending->id]) }}"
                                            class="btn btn-icon btn-sm btn-info-light"><i
                                                class="ri-edit-line"></i></a>
                                        <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete"
                                            data-id="{{ $blogPending->id }}" data-route="{{ url("/admin/post/delete/$blogPending->id") }}"
                                            {{ $blogPending->status == 'off' ? 'disabled' : '' }}><i
                                                class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="tab-pane p-0" id="completed" role="tabpanel">
        <div class="row">
            @foreach ($blogcompleteds as $blogcompleted)
                <div class="col-xl-4">
                    <div class="card custom-card task-pending-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div>
                                    <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                            href="javascript:void(0);"></a>{{ $blogcompleted->title }}
                                    </p>
                                    <p class="mb-3">Ngày tạo : <span
                                            class="fs-12 mb-1 text-muted">{{ $blogcompleted->created_at }}</span></p>
                                    <p class="mb-3">Ngày xuất bản : <span
                                            class="fs-12 mb-1 text-muted">{{ $blogcompleted->publish_date }}</span></p>
                                    <p class="mb-0">Người tạo :
                                        <span class="avatar-list-stacked ms-1">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ url("storage/uploads/blog_images/$blogcompleted->title/thumbnail/$blogcompleted->thumbnail") }}"
                                                    alt="img">
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <div class="btn-list">
                                        <a href="{{ route('admin.post.edit',['id'=>$blogcompleted->id]) }}"
                                            class="btn btn-icon btn-sm btn-info-light"><i
                                                class="ri-edit-line"></i></a>
                                        <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnPostDelete" data-route="{{ url("/admin/post/delete/$blogcompleted->id") }}"
                                            data-id="{{ $blogcompleted->id }}"
                                            {{ $blogcompleted->status == 'off' ? 'disabled' : '' }}><i
                                                class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
