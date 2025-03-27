<?php 
$pageTitle = 'Thêm nhân viên - Quản lý nhân sự';
require 'views/layouts/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Thêm nhân viên mới</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="ma_nv" class="form-label">Mã nhân viên</label>
                            <input type="text" class="form-control" id="ma_nv" name="ma_nv" required maxlength="3">
                        </div>
                        
                        <div class="mb-3">
                            <label for="ten_nv" class="form-label">Tên nhân viên</label>
                            <input type="text" class="form-control" id="ten_nv" name="ten_nv" required maxlength="100">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Giới tính</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="phai" id="nam" value="NAM" required>
                                    <label class="form-check-label" for="nam">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="phai" id="nu" value="NU">
                                    <label class="form-check-label" for="nu">Nữ</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="noi_sinh" class="form-label">Nơi sinh</label>
                            <input type="text" class="form-control" id="noi_sinh" name="noi_sinh" required maxlength="200">
                        </div>
                        
                        <div class="mb-3">
                            <label for="ma_phong" class="form-label">Phòng ban</label>
                            <select class="form-select" id="ma_phong" name="ma_phong" required>
                                <option value="">Chọn phòng ban</option>
                                <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept['Ma_Phong']; ?>">
                                    <?php echo htmlspecialchars($dept['Ten_Phong']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="luong" class="form-label">Lương</label>
                            <input type="number" class="form-control" id="luong" name="luong" required min="0">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
                            <a href="<?php echo BASE_URL; ?>/index.php?action=index" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layouts/footer.php'; ?>
