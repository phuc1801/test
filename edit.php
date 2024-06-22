<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include('connect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlID = "SELECT * FROM donhang WHERE id = :id";
    $stmt = $conn->prepare($sqlID);
    $stmt->execute([':id' => $id]);
    $vandon = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$vandon) {
        echo "Vận đơn không tồn tại!";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
    $khachhang_id = htmlspecialchars($_POST['khachhang_id']);
    $trangthai = htmlspecialchars($_POST['trangthai']);
    $khuyenmai = htmlspecialchars($_POST['khuyenmai']);
    $ngayban = htmlspecialchars($_POST['ngayban']);
    $ngaygiaohang = htmlspecialchars($_POST['ngaygiaohang']);
    $ghichu = htmlspecialchars($_POST['ghichu']);
       
    $sql = "UPDATE donhang SET khachhang_id = :khachhang_id, trangthai = :trangthai, khuyenmai = :khuyenmai, ngayban = :ngayban, ngaygiaohang = :ngaygiaohang, ghichu = :ghichu WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $params = [
        ':id' => $id,
        ':khachhang_id' => $khachhang_id,
        ':trangthai' => $trangthai,
        ':khuyenmai' => $khuyenmai,
        ':ngayban' => $ngayban,
        ':ngaygiaohang' => $ngaygiaohang,
        ':ghichu' => $ghichu
    ];

    if ($stmt->execute($params)) {
        header('Location: list.php');
        exit();
    } else {
        $error = "Thêm vận đơn thất bại, vui lòng thử lại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Vận Đơn</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Thêm Vận Đơn</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" name="id" id="id" value="<?= htmlspecialchars($vandon['id']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="khachhang_id">Mã khách hàng</label>
                        <input type="text" class="form-control" name="khachhang_id" id="khachhang_id" value="<?= htmlspecialchars($vandon['khachhang_id']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="trangthai">Trạng thái</label>
                        <input type="text" class="form-control" name="trangthai" id="trangthai" value="<?= htmlspecialchars($vandon['trangthai']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="khuyenmai">Khuyến mại</label>
                        <input type="text" class="form-control" name="khuyenmai" id="khuyenmai" value="<?= htmlspecialchars($vandon['khuyenmai']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ngayban">Ngày bán</label>
                        <input type="datetime-local" class="form-control" name="ngayban" id="ngayban" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($vandon['ngayban']))) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ngaygiaohang">Ngày giao hàng</label>
                        <input type="datetime-local" class="form-control" name="ngaygiaohang" id="ngaygiaohang" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($vandon['ngaygiaohang']))) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ghichu">Ghi chú</label>
                        <textarea class="form-control" name="ghichu" id="ghichu"><?= htmlspecialchars($vandon['ghichu']) ?></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block mt-3">Lưu</button>
                </form>
            </div>
            <div class="card-footer text-center">
                Nguyễn Duy Phúc - 90606
            </div>
        </div>
    </div>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>