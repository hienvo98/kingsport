<div class="tab-content task-tabs-container">
    <div class="tab-pane show active p-0" id="all-tasks"role="tabpanel">
        <div class="row" id="tasks-container">
            @if ($events)
                @foreach ($events as $event)
                    <div class="col-xl-4 task-card current">
                        <div class="card custom-card <?php if ($event->status == 'off') {
                            echo 'task-pending-card';
                        } else {
                            echo 'task-completed-card';
                        } ?>" style="height: 290px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div>
                                        <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                                href="javascript:void(0);"></i></a>{{ CustomHelper::customName($event->name, 15) }}
                                        </p>
                                        <p class="mb-3">Ngày tạo : <span
                                                class="fs-12 mb-1 text-muted">{{ $event->created_at }}</span></p>
                                        {{-- <p class="mb-3">Ngày xuất bản : <span
                                                class="fs-12 mb-1 text-muted">{{ $event->publish_date }}</span></p> --}}
                                        <p class="mb-3">Người tạo :
                                            <span class="avatar-list-stacked ms-1">
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ url("storage/uploads/event/$event->name/banner/$event->banner") }}"
                                                        alt="img">
                                                </span>
                                            </span>
                                        </p>
                                        @if ($event->status == 'on')
                                            <p class="mb-0">Trạng Thái: <span class="text-primary bg-light">Hiển
                                                    thị</span>
                                            @else
                                            <p class="mb-0">Trạng Thái: <span class="text-danger bg-light">Ẩn</span>
                                        @endif
                                        </p>
                                    </div>
                                    <div>
                                        <div class="btn-list">
                                            <a href="{{ route('admin.event.edit', ['id' => $event->id]) }}"
                                                class="btn btn-icon btn-sm btn-info-light"><i
                                                    class="ri-edit-line"></i></a>
                                            <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete"
                                                data-route="{{ url("/admin/event/delete/$event->id") }}"
                                                {{ $event->status == 'off' ? 'disabled' : '' }}><i
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
            @foreach ($unpublished_event_list as $event)
                <div class="col-xl-4 current">
                    <div class="card custom-card task-pending-card" style="height: 290px">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div>
                                    <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                            href="javascript:void(0);"></i></a>{{ CustomHelper::customName($event->title, 15) }}
                                    </p>
                                    <p class="mb-3">Ngày tạo : <span
                                            class="fs-12 mb-1 text-muted">{{ $event->created_at }}</span></p>
                                    <p class="mb-3">Ngày xuất bản : <span
                                            class="fs-12 mb-1 text-muted">{{ $event->publish_date }}</span></p>
                                    <p class="mb-0">Người tạo :
                                        <span class="avatar-list-stacked ms-1">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ url("storage/uploads/blog_images/$event->title/thumbnail/$event->thumbnail") }}"
                                                    alt="img">
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <div class="btn-list">
                                        <a href="{{ route('admin.post.edit', ['id' => $event->id]) }}"
                                            class="btn btn-icon btn-sm btn-info-light"><i class="ri-edit-line"></i></a>
                                        <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete"
                                            data-id="{{ $event->id }}"
                                            data-route="{{ url("/admin/post/delete/$event->id") }}"
                                            {{ $event->status == 'off' ? 'disabled' : '' }}><i
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
            @foreach ($published_event_list as $event)
                <div class="col-xl-4 current">
                    <div class="card custom-card task-pending-card" style="height: 290px">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <div>
                                    <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                            href="javascript:void(0);"></a>{{ CustomHelper::customName($event->title, 15) }}
                                    </p>
                                    <p class="mb-3">Ngày tạo : <span
                                            class="fs-12 mb-1 text-muted">{{ $event->created_at }}</span></p>
                                    <p class="mb-3">Ngày xuất bản : <span
                                            class="fs-12 mb-1 text-muted">{{ $event->publish_date }}</span></p>
                                    <p class="mb-0">Người tạo :
                                        <span class="avatar-list-stacked ms-1">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ url("storage/uploads/blog_images/$event->title/thumbnail/$event->thumbnail") }}"
                                                    alt="img">
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <div class="btn-list">
                                        <a href="{{ route('admin.post.edit', ['id' => $event->id]) }}"
                                            class="btn btn-icon btn-sm btn-info-light"><i class="ri-edit-line"></i></a>
                                        <button class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete"
                                            data-route="{{ url("/admin/post/delete/$event->id") }}"
                                            data-id="{{ $event->id }}"
                                            {{ $event->status == 'off' ? 'disabled' : '' }}><i
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
