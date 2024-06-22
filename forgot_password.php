<?php 
    if(isset($_POST['doimk'])){
        $username = htmlspecialchars(trim($_POST['username']));
        $newpass = htmlspecialchars($_POST['newpass']);
        $confirmPass = htmlspecialchars($_POST['confirmPass']);

        // Kiểm tra xem mật khẩu nhập lại có khớp không
        if($newpass !== $confirmPass){
            echo '<div class="alert alert-danger" role="alert">Mật khẩu nhập lại không khớp</div>';
           
        }else{
            // Include file kết nối đến database
            include('connect.php');

            // Chuẩn bị và thực thi câu lệnh SQL
            $updateSql = "UPDATE user SET matkhau = :password WHERE username = :username";
            $stmt = $conn->prepare($updateSql);
            $stmt->bindParam(':password', $newpass, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Kiểm tra và hiển thị thông báo
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                echo '<div class="alert alert-success" role="alert">Đổi mật khẩu thành công!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Đổi mật khẩu thất bại. Tài khoản không tồn tại!</div>';
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
    <title>Đổi Mật Khẩu</title>
</head>
<body>
    <div class="container">
        <form method="post" action="">
            <fieldset class="form-group">
                <label for="username">Tài khoản</label>
                <input type="text" class="form-control" name="username" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="newpass">Mật khẩu mới</label>
                <input type="password" class="form-control" name="newpass" required>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirmPass">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="confirmPass" required>
            </fieldset>
            <fieldset class="form-group">
                <input type="submit" class="btn bg-dark mt-3" value="ĐỔI MẬT KHẨU" style="color: white;" name="doimk">
                <a href="login.php"><input type="button" class="btn bg-primary mt-3" value="ĐĂNG NHẬP" style="color: white;"></a>
            </fieldset>
        </form>
    </div>
</body>
</html>
