<?php
include('connect.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
if(isset($_POST['search'])){
    $khachhang_id = htmlspecialchars($_POST['khachhang_id']);
    $sql = "SELECT * FROM donhang WHERE khachhang_id = :khachhang_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':khachhang_id' => $khachhang_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
    $sql = "SELECT * FROM donhang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>Document</title>
</head>
<body>
    <header class="text-center">QUẢN LÝ BÁN HÀNG
        <br>
        <img class="image" src="./assets/img/images.jpg" alt="">
    </header>
    <content>
        <div class="container">
            <ul class="nav">
                <li class="nav-item"><a href="" class="nav-link">Trang chủ</a></li>
                <li class="nav-item"><a href="list.php" class="nav-link">Danh sách bán hàng</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Đăng xuất</a></li>
            </ul>
            <form action="" method="post" class="mt-3">
                <label for="nhanvien_id">Nhập mã khách hàng</label>
                <input type="text" style="width: 300px; padding: 3px;" name="khachhang_id">
                <button name ="search" class="btn bg-primary">Tìm kiếm</button>
                <a href="add.php" class="btn bg-warning">Thêm</a>
            </form>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Mã khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Khuyến mại</th>
                        <th>Ngày bán</th>
                        <th>Ngày giao hàng</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['khachhang_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['trangthai']); ?></td>
                            <td><?php echo htmlspecialchars($row['khuyenmai']); ?></td>
                            <td><?php echo htmlspecialchars($row['ngayban']); ?></td>
                            <td><?php echo htmlspecialchars($row['ngaygiaohang']); ?></td>
                            <td><?php echo htmlspecialchars($row['ghichu']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn bg-warning">Sửa</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn bg-danger">Xoá</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </content>
    <footer>
        <p>Tên người dùng: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Không có người dùng'; ?></p>   
        <br>    
        90606 - Nguyễn Duy Phúc - N02  
    </footer>
    
</body>
</html>