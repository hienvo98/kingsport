<div class="tab-content task-tabs-container">
    <div class="tab-pane show active p-0" id="all-tasks"role="tabpanel">
        <div class="row" id="tasks-container">
            @if ($regions->isEmpty())
                <p>Không có dữ liệu về showroom.</p>
            @else
                @foreach ($regions as $region)
                    @foreach ($region->showroom as $showroom)
                    <div class="col-xl-4 current">
                        <div class="card custom-card task-pending-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap gap-2">
                                    <div>
                                        <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                                href="javascript:void(0);"></a>{{ CustomHelper::customName($showroom->name, 15) }}
                                        </p>
                                        <p class="mb-3">Địa chỉ : <span
                                                class="fs-12 mb-1 text-muted">{{ $showroom->address }}</span>
                                        </p>
                                        <p class="mb-3">Số điện thoại : <span
                                                class="fs-12 mb-1 text-muted">{{ $showroom->phone }}</span></p>
                                        <p class="mb-0">Người tạo :
                                            <span class="avatar-list-stacked ms-1">
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ url("storage/uploads/showroom-images/$showroom->name/thumbnail/$showroom->thumbnail") }}"
                                                        alt="img">
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="btn-list">
                                            <a href="{{ route('admin.showroom.edit', ['id' => $showroom->id]) }}"
                                                class="btn btn-icon btn-sm btn-info-light"><i
                                                    class="ri-edit-line"></i></a>
                                            <button
                                                class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete"
                                                data-route="{{ url("/admin/showroom/delete/$showroom->id") }}"
                                                data-id="{{ $showroom->id }}"
                                                {{ $showroom->status == 'off' ? 'disabled' : '' }}><i
                                                    class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
    <div class="tab-pane p-0" id="completed" role="tabpanel">
        <div class="row">
            @if ($regions->isEmpty())
                <p>Không có dữ liệu về showroom.</p>
            @else
                @foreach ($regions as $region)
                    @foreach ($region->showroom as $showroom)
                        @if ($showroom->status == 'on')
                        <div class="col-xl-4 current">
                            <div class="card custom-card task-pending-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-wrap gap-2">
                                        <div>
                                            <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                                    href="javascript:void(0);"></a>{{ CustomHelper::customName($showroom->name, 15) }}
                                            </p>
                                            <p class="mb-3">Địa chỉ : <span
                                                    class="fs-12 mb-1 text-muted">{{ $showroom->address }}</span>
                                            </p>
                                            <p class="mb-3">Số điện thoại : <span
                                                    class="fs-12 mb-1 text-muted">{{ $showroom->phone }}</span></p>
                                            <p class="mb-0">Người tạo :
                                                <span class="avatar-list-stacked ms-1">
                                                    <span class="avatar avatar-sm avatar-rounded">
                                                        <img src="{{ url("storage/uploads/showroom-images/$showroom->name/thumbnail/$showroom->thumbnail") }}"
                                                            alt="img">
                                                    </span>
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <div class="btn-list">
                                                <a href="{{ route('admin.showroom.edit', ['id' => $showroom->id]) }}"
                                                    class="btn btn-icon btn-sm btn-info-light"><i
                                                        class="ri-edit-line"></i></a>
                                                <button
                                                    class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete"
                                                    data-route="{{ url("/admin/showroom/delete/$showroom->id") }}"
                                                    data-id="{{ $showroom->id }}"
                                                    {{ $showroom->status == 'off' ? 'disabled' : '' }}><i
                                                        class="ri-delete-bin-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
    <div class="tab-pane p-0" id="pending" role="tabpanel">
        <div class="row">
            @if ($regions->isEmpty())
                <p>Không có dữ liệu về showroom.</p>
            @else
                @foreach ($regions as $region)
                    @foreach ($region->showroom as $showroom)
                        @if ($showroom->status == 'off')
                            <div class="col-xl-4 current">
                                <div class="card custom-card task-pending-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between flex-wrap gap-2">
                                            <div>
                                                <p class="fw-semibold mb-3 d-flex align-items-center"><a
                                                        href="javascript:void(0);"></a>{{ CustomHelper::customName($showroom->name, 15) }}
                                                </p>
                                                <p class="mb-3">Địa chỉ : <span
                                                        class="fs-12 mb-1 text-muted">{{ $showroom->address }}</span>
                                                </p>
                                                <p class="mb-3">Số điện thoại : <span
                                                        class="fs-12 mb-1 text-muted">{{ $showroom->phone }}</span></p>
                                                <p class="mb-0">Người tạo :
                                                    <span class="avatar-list-stacked ms-1">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ url("storage/uploads/showroom-images/$showroom->name/thumbnail/$showroom->thumbnail") }}"
                                                                alt="img">
                                                        </span>
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <div class="btn-list">
                                                    <a href="{{ route('admin.showroom.edit', ['id' => $showroom->id]) }}"
                                                        class="btn btn-icon btn-sm btn-info-light"><i
                                                            class="ri-edit-line"></i></a>
                                                    <button
                                                        class="btn btn-sm btn-icon btn-wave btn-danger-light me-0 btnDelete"
                                                        data-route="{{ url("/admin/showroom/delete/$showroom->id") }}"
                                                        data-id="{{ $showroom->id }}"
                                                        {{ $showroom->status == 'off' ? 'disabled' : '' }}><i
                                                            class="ri-delete-bin-line"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/showroom.js') }}"></script>