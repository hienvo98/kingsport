
<div class="modal fade" id="createSubCateModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tạo Thuộc Tính</h5>
                <button style="margin-right:3%;" type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body add-products p-0">
                    <form id="sub-categoryForm">
                        @csrf
                        <div class="p-4">
                            <div class="row gx-5">
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-6">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3">
                                            
                                                <div class="col-xl-12">
                                                    <label for="product-name-add" class="form-label">Danh Mục Cha</label>
                                                    <input type="text" readonly class="form-control" name="category_name" id="SubCategory_name" placeholder="Name">
                                                </div>
                                                <div class="col-xl-12">
                                                    <label for="product-name-add" class="form-label">Tên Thuộc Tính</label>
                                                    <input type="text" class="form-control" name="sub_category_name" placeholder="Name" required>
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
                                                    <label for="product-status" class="form-label">Trạng Thái</label>
                                                    <select class="form-control" name="status" id="product-status">
                                                        <option value="true">Bật</option>
                                                        <option value="false">Tắt</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-12">
                                                    <label for="product-order" class="form-label">Số Thứ Tự</label>
                                                    <input type="text" class="form-control" name="ordinal_number" id="sub_ordinal_number"/>
                                                    <input type="hidden" name="sub_ordinal_number" value="">
                                                </div>                                         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <button style="margin-right:3%;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button id="btnAddSubCate" class="btn btn-primary btnAddSubCate">Thêm<i class="bi bi-plus-lg ms-2"></i></button>
                        </div>
                    </div>
                    </form>                 
                </div>
            </div>
            </div>
        </div>
    </div>
</div>