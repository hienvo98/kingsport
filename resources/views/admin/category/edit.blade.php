<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa Danh Mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body add-products p-0">
                        <input type="hidden" id="category_id">
                        <form id="editCategoryForm" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="p-4">
                                <div class="row gx-5">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-6">
                                        <div class="card custom-card shadow-none mb-0 border-0">
                                            <div class="card-body p-0">
                                                <div class="row gy-3">
                                                    <div class="col-xl-12">
                                                        <label for="product-name-add" class="form-label">Tên Danh
                                                            Mục</label>
                                                        <input type="text" class="form-control" name="category_name"
                                                            id="categories_name" placeholder="Name" required>
                                                        <label for="product-name-add"
                                                            class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Category
                                                            Name should not exceed 30 characters</label>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <label for="" class="form-label">Ảnh Đại Diện Danh
                                                            Mục</label>
                                                        <input type="file" class="form-control" name="avatar"
                                                            placeholder="Name">
                                                        <img style="display: none" src="" id="imageCatEdit"
                                                            alt="Image"
                                                            class="img-fluid img-thumbnail rounded mt-2" />
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <label for="product-status" class="form-label">Trạng
                                                            Thái</label>
                                                        <select class="form-control" name="status"
                                                            id="categories_status">
                                                            <option value="true">Bật</option>
                                                            <option value="false">Tắt</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <label for="product-order" class="form-label">Số Thứ Tự</label>
                                                        <input type="text" class="form-control" name="ordinal_number"
                                                            id="categories_ordinal_number" />
                                                        <input type="hidden" id="editNumber" name="ordinal_number"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button class="btn btn-primary" id="saveChangesBtn">Lưu Thay Đổi</button>
            </div>
            </form>
        </div>
    </div>
</div>
