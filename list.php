<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('connect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $khachhang_id = htmlspecialchars($_POST['khachhang_id']);
    $sql = "SELECT * FROM `donhang` WHERE khachhang_id = :khachhang_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':khachhang_id' => $khachhang_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM `donhang`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>QUẢN LÝ VẬN ĐƠN</title>
    <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/main.css">
</head>
<body>
    <header><center>QUẢN LÝ VẬN ĐƠN</center></header>
    <content>
        <div class="container"> 
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list.php">Danh sách vận đơn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Đăng xuất</a>
                </li>
            </ul>
            <br>
            <form method="post">
                <label>TÌM KIẾM THEO NHÂN VIÊN PHỤ TRÁCH</label>
                <input type="text" name="khachhang_id" placeholder="Nhập mã Nhân viên" style="width: 300px; padding: 3px; ">
                <button type="submit" name="submit" class="btn btn-primary">Tìm kiếm</button>
                <a href="add.php" class="btn btn-success">Thêm</a>
            </form>
            <br>
            <table class="table table-inverse">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Mã khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Khuyến mại</th>
                        <th>Ngày bán</th>
                        <th>Ngày giao hàng</th>
                        <th>Ghi chú</th>
                
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $items): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($items['id']); ?></td>
                        <td><?php echo htmlspecialchars($items['khachhang_id']); ?></td>
                        <td><?php echo htmlspecialchars($items['trangthai']); ?></td>
                        <td><?php echo htmlspecialchars($items['khuyenmai']); ?></td>
                        <td><?php echo htmlspecialchars($items['ngayban']); ?></td>
                        <td><?php echo htmlspecialchars($items['ngaygiaohang']); ?></td>
                        <td><?php echo htmlspecialchars($items['ghichu']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $items['id']; ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete.php?id=<?php echo $items['id']; ?>" class="btn btn-danger" style="margin-top: 2px;">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </content>
    <footer><center>Nguyễn Duy Phúc - 90606</center></footer>
</body>
</html>
