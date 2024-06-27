<?php
    session_start();

    function Connect(){
        $conn = mysqli_connect(
            "localhost",
            "root",
            "",
            "db_weblaptop"
        );
        mysqli_set_charset($conn, "utf8");
        return $conn;
    }
    
    if(mysqli_connect_errno()){
        echo "ket noi bi loi";
    }else{
    }
?>
