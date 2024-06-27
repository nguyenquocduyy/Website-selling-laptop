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
$MASP = $_GET['masp'];
$sql="DELETE FROM sanphamgiohang WHERE MASP='$MASP'";
if($conn->query($sql)==true){
    header('Location: cart.php');
}else{  
    echo "error: ".$sql."<br>".$conn->error;
}
$conn->close();