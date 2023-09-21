
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tạo Mới Danh Mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body add-products p-0">
                    <form id="categoryForm">
                        @csrf
                        <div class="p-4">
                            <div class="row gx-5">
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-6">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3">
                                                <div class="col-xl-12">
                                                    <label for="product-name-add" class="form-label">Tên Danh Mục</label>
                                                    <input type="text" class="form-control" name="category_name" placeholder="Name" required>
                                                    <label for="product-name-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Category Name should not exceed 30 characters</label>
                                                </div>
                                                <div class="col-xl-12">
                                                    <label for="product-status" class="form-label">Trạng Thái</label>
                                                    <select class="form-control" name="status" id="product-status">
                                                        <option value="true">Bật</option>
                                                        <option value="false">Tắt</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-12">
                                                    <label for="product-order" class="form-label">Số Thứ Tự</label>
                                                    <input type="number" class="form-control" name="ordinal_number" required id="ordinal_number" />
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <button style="margin-right:3%;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="btnAddCategory" class="btn btn-primary">Thêm<i class="bi bi-plus-lg ms-2"></i></button>
                        </div>
                    </div>
                    </form>                 
                </div>
            </div>
            </div>
        </div>
    </div>
</div>