<?php
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="db_weblaptop";
        $conn=new mysqli($servername,$username,$password,$dbname);
        $conn->set_charset("utf8"); 
        if($conn->connect_error){
            die("Connection fail: ".$conn->connect_error);
        }
?>
