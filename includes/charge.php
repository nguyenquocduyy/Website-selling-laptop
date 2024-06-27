<?php
  require_once('./config.php');
  require_once('./include.php');
  $tongtien = $_POST['tongtien'];
  $amount = $tongtien*100;
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $madh = uniqid();
  $taikhoan = $_POST['taikhoan'];
  $diachi = $_POST['diachi'];
  $ngaydat = date("Y-m-d");
  $trangthai = 'Chưa xác nhận';

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'usd',
      'metadata' => ['order_id' => $madh]
  ]);
  
  function Get_Info_Account($taikhoan){
    $sql = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan'";
    $res = Check_db($sql);
    $row = mysqli_fetch_assoc($res);
    $tennd = $row['TENND'];
    $sdt = $row['SDT'];
    $diachi = $row['DIACHI'];
    $email = $row['EMAIL'];
    $ngaysinh = $row['NGAYSINH'];
    $thongtin = array('tennd'=>$tennd, 'sdt'=>$sdt, 'diachi'=>$diachi, 'email'=>$email, 'ngaysinh'=>$ngaysinh);
    return $thongtin;
  }

function Del_Cart($taikhoan){
    $sql = "DELETE FROM SANPHAMGIOHANG WHERE taikhoan = '$taikhoan'";
    $res = Check_db($sql);
}

function Add_Product($madh, $taikhoan){
  $sql = "SELECT * FROM SANPHAMGIOHANG WHERE taikhoan = '$taikhoan'";
  $res = Check_db($sql);
  while ($row = mysqli_fetch_assoc($res)) {
      $masp = $row['MASP'];
      echo $masp;
      $soluong = $row['SOLUONGGIO'];
      echo $soluong;
      $sql_add = "INSERT INTO `monhang` (`MADH`, `MASP`, `SOLUONGDAT`) VALUES ('$madh', '$masp', '$soluong');";
      $res_add = Check_db($sql_add);
  }
}

if($charge->status == "succeeded"){
  $htthanhtoan = 'Online';
  $sql_create_order = "INSERT INTO `donhang` (`MADH`, `TAIKHOAN`, `TRANGTHAI`, `NGAYDAT`, `HTTHANHTOAN`, `DIACHINHAN`, `TONGTIEN`) 
                      VALUES ('$madh', '$taikhoan', '$trangthai', '$ngaydat', '$htthanhtoan', '$diachi', '$tongtien');";
  $res_create_order = Check_db($sql_create_order);
  if($res_create_order){
      Add_Product($madh, $taikhoan);
      Del_Cart($taikhoan);
      echo "<script>alert('Thanh toán online thành công')</script>";
      header('location: ../account.php');
  }
}
?>