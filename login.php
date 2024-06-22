<?php
	session_start();
	include('connect.php');
	if(!empty($_POST['dangnhap'])){
		if(isset($_POST['username'])&&isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM user WHERE username = '$username' AND matkhau = '$password'";
			$stmt = $conn->prepare($sql);
			$query = $stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$row){
				echo "Đăng nhập thất bại";
			}
			else{
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
			}
		}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script src="./assets/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header class="mt-5" style="text-align: center; font-size: 30px;">Quản lý tài khoản</header>
    <div class="container">
        <form action="" method="post">
            <fieldset class="form-group">
                <label for="">Tài khoản</label>
                <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản">
            </fieldset>
            <fieldset class="form-group">
                <label for="">Mật khẩu</label>
                <input type="text" class="form-control" name="password" placeholder ="Nhập mật khẩu">
            </fieldset>
            <fieldset class="form-group">
                <input type="submit" class="bg-dark form-control mt-3" value="ĐĂNG NHẬP" style="color: white;" name="dangnhap">
                <a href="forgot_password.php" class="btn btn-primary mt-3" style="color: white;">Quên mật khẩu</a>
            </fieldset>
        </form>
    </div>
</body>
</html>