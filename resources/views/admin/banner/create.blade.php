<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tạo Banner</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                <button style="margin-right:3%;" type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body add-products p-0">
                            <form id="tagForm" method="POST" data-route="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="p-4">
                                    <div class="row gx-5">
                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-6">
                                            <div class="card custom-card shadow-none mb-0 border-0">
                                                <div class="card-body p-0">
                                                    <div class="row gy-3">
                                                        <div class="col-xl-12">
                                                            <label for="product-name-add" class="form-label">Tên</label>
                                                            <input type="text" id="blog-title" class="form-control"
                                                                name="name" placeholder="Name" id="tagName" required>
                                                        </div>
                                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                        <input type="hidden" id="blog-url" name="url" value="">
                                                        <div class="col-xl-12">
                                                            <label for="blog-thumbnail"
                                                                class="form-label">Banner</label>
                                                            <input type="file" class="form-control thumbnail "
                                                                name="imageThumb" id="thumbnail"
                                                                placeholder="Thumbnail" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for=""
                                                                class="form-label">Ảnh Banner:</label><br>
                                                            <img style="display: none" id="thumbnailImg"
                                                                src="" alt=""
                                                                class="img-fluid img-thumbnail rounded">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="product-name-add" p class="form-label">Seo Title</label>
                                                            <input type="text" class="form-control"
                                                                name="seo_title" placeholder="Iphone 15 Promax Free" id="tagName" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="product-name-add" p class="form-label">Seo Keywords</label>
                                                            <input type="text" class="form-control"
                                                                name="seo_keywords" placeholder="Iphone 15 Promax Free" id="tagName" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="product-name-add" p class="form-label">Seo Description</label>
                                                            <textarea style="resize: none" class="form-control" name="seo_description" id="exampleFormControlTextarea1" rows="5" required></textarea>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="product-status" class="form-label">Trạng
                                                                Thái</label>
                                                            <select class="form-control" name="status"
                                                                id="product-status">
                                                                <option value="on">Bật</option>
                                                                <option value="off">Tắt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                                    <button style="margin-right:3%;" type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button id="btnAddCategory" class="btn btn-primary">Tải lên<i
                                            class="bi bi-plus-lg ms-2"></i></button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
