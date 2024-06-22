<?php 
include('connect.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlID = "DELETE FROM donhang WHERE id = :id";
    $stmt = $conn->prepare($sqlID);
    $stmt->execute([':id' => $id]);
    $vandon = $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: list.php");
    exit();
}

?>