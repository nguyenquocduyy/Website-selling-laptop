<?php
 require_once('./includes/include.php');
require_once('./includes/conn.php');
    $taikhoan=$_SESSION['taikhoan'];
    $masp=$_POST['masp'];
    $soluonggio = $_POST['soluonggio'];
    $sql = "UPDATE sanphamgiohang SET SOLUONGGIO='$soluonggio' WHERE TAIKHOAN='$taikhoan' AND MASP='$masp'";
    if ($res = Check_db($sql)) {
        echo "<script>alert('Cập nhật thành công!') </script>";
        echo "<script>window.open('cart.php','_self')</script>";
    } else {
        echo "<script>alert('sua gio hang that bai')</script>";
    }

?>