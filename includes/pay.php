<?php 
    function Create_Order(){
        $thongtin = Get_Info_Account($_SESSION['taikhoan']);
        $madh = uniqid();
        $taikhoan = $_SESSION['taikhoan'];
        $diachi = $thongtin['diachi'];
        $taikhoan = $_SESSION['taikhoan'];
        $trangthai = 'Chưa xác nhận';
        $ngaydat = date("Y-m-d");
        $htthanhtoan = 'Offline';
        $sql_create_order = "INSERT INTO `donhang` (`MADH`, `TAIKHOAN`, `TRANGTHAI`, `NGAYDAT`, `HTTHANHTOAN`, `DIACHINHAN`, `TONGTIEN`) 
                            VALUES ('$madh', '$taikhoan', '$trangthai', '$ngaydat', '$htthanhtoan', '$diachi', '$tongtien');";
        $res_create_order = Check_db($sql_create_order);
        if($res_create_order){
            $monhang = Get_Cart($taikhoan);
            Add_Product($madh, $monhang);
            Del_Cart($taikhoan);
        }
    }
?>