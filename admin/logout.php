<?php 
    include_once('./includes/include.php');
    if(isset($_SESSION['taikhoan'])){
        session_destroy();
    }
    header('location: ../login.php');
?>