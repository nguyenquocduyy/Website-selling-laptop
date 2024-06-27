<?php
    //$_SESSION['TAIKHOAN'];
    $MASP=$_GET['masp'];
    include('tsx_SP_gio.php');
    themSP_gio($MASP);
    //header('Location: view.php?tenbien='.$MASP);

?>