<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
</head>
<body>
    <header><Center>QUẢN LÝ BÁN HÀNG</Center>
        <br>
        <img class="image" src="./assets/img/images.jpg" alt="">
    </header>
    <content>
        <div class="container">
            <ul class="nav">
                <li class="nav-item"><a href="" class="nav-link">Trang chủ</a></li>
                <li class="nav-item"><a href="" class="nav-link">Danh sách bán hàng</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Đăng xuất</a></li>
            </ul>
        </div>
    </content>
    <footer>
        <p>Tên người dùng: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Không có người dùng'; ?></p>   
        <br>    
        90606 - Nguyễn Duy Phúc - N02  
    </footer>
</body>
</html>