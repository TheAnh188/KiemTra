<?php 
$pageTitle = 'Danh sách nhân viên - Quản lý nhân sự';
require 'views/layouts/header.php';
?>

<div class="container mt-4">
    <?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="text-end mb-3">
        <a href="<?php echo BASE_URL; ?>/index.php?action=add" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm nhân viên
        </a>
    </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Mã NV</th>
                    <th>Tên nhân viên</th>
                    <th>Giới tính</th>
                    <th>Nơi sinh</th>
                    <th>Tên phòng</th>
                    <th>Lương</th>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                    <th>Thao tác</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['Ma_NV']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Ten_NV']); ?></td>
                    <td>
                        <?php if ($employee['Phai'] === 'NU'): ?>
                        <img src="<?php echo BASE_URL; ?>/public/images/woman.jpg" alt="Nữ" class="gender-icon">
                        <?php else: ?>
                        <img src="<?php echo BASE_URL; ?>/public/images/man.jpg" alt="Nam" class="gender-icon">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($employee['Noi_Sinh']); ?></td>
                    <td><?php echo htmlspecialchars($employee['Ten_Phong']); ?></td>
                    <td><?php echo number_format($employee['Luong']); ?></td>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                    <td>
                        <a href="<?php echo BASE_URL; ?>/index.php?action=edit&id=<?php echo $employee['Ma_NV']; ?>" 
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?php echo BASE_URL; ?>/index.php?action=delete&id=<?php echo $employee['Ma_NV']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo BASE_URL; ?>/index.php?action=index&page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<?php require 'views/layouts/footer.php'; ?>
