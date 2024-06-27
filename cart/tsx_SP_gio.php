<?php

    function test($sql){
        include('connectDB.php');
        $request=$conn->query($sql);
        if(mysqli_num_rows($request)>0){
            $row=$request->fetch_assoc();
            return $row;
        }else return null;
        $conn->close();
    }

    function update($sql_update){
        include('connectDB.php');
        if($conn->query($sql_update)!=true){
            echo "error: ".$sql_update."<br>".$conn->error;
        }
        $conn->close();
    }
    function themSP_gio($MASP){
        $TAIKHOAN=$_SESSION['taikhoan'];
        $row_SPGH=test("SELECT*FROM sanphamgiohang,sanpham WHERE sanphamgiohang.MASP=sanpham.MASP and TAIKHOAN='$TAIKHOAN' AND sanphamgiohang.MASP='$MASP'");
        if($row_SPGH!=null){
            $SOLUONGGIO=$row_SPGH['SOLUONGGIO'];
            $SOLUONGCON=$row_SPGH['SOLUONGCON'];
            if($SOLUONGGIO<$SOLUONGCON){
                $SOLUONGGIO=$row_SPGH['SOLUONGGIO']+1;
                update("UPDATE sanphamgiohang SET SOLUONGGIO='$SOLUONGGIO' WHERE TAIKHOAN='$TAIKHOAN' AND MASP='$MASP'");
                echo "<script>
                    alert('Thêm thành công!');
                    </script>";
            }else {
                echo "<script>
                    alert('Thêm không thành công!');
                    </script>";
            }
        }else{
            include('connectDB.php');
            $sql="INSERT INTO sanphamgiohang VALUES('$MASP','$TAIKHOAN','1')";
            if($conn->query($sql)!=true){
                echo "error: ".$sql."<br>".$conn->error;
            }else echo "<script>
            alert('Thêm thành công!');
            </script>";
            $conn->close();
        }
    }

    function sua_SP_gio($SOLUONGGIO){
        include('connectDB.php');
        $TAIKHOAN=$_SESSION['taikhoan'];
        $row_SPGH=test("SELECT*FROM sanphamgiohang WHERE TAIKHOAN='$TAIKHOAN' AND MASP='$MASP'");
        if($row_SPGH!=null){
            update("UPDATE sanphamgiohang SET SOLUONGGIO='$SOLUONGGIO' WHERE TAIKHOAN='$TAIKHOAN' AND MASP='$MASP");
        }
        $conn->close();
    }

    function xoa_SP_gio($MASP){
        include('connectDB.php');
        $sql="DELETE FROM sanphamgiohang WHERE MASP='$MASP'";
        if($conn->query($sql)==true){
            header('Location: ./cart.php');
        }else{
            echo "error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
    }

    function view_sp_gio($TAIKHOAN){
        include('connectDB.php');
        $sql="SELECT sanphamgiohang.MASP,LINK,sanpham.TENSP,sanpham.GIA,SOLUONGGIO FROM hinhanh,sanpham,sanphamgiohang WHERE sanpham.MASP=hinhanh.MASP AND sanphamgiohang.MASP=sanpham.MASP AND sanphamgiohang.TAIKHOAN='$TAIKHOAN'";
        if($conn->query($sql)==true){
            $request=mysqli_query($conn,$sql);
            if(mysqli_num_rows($request)>0){
                while($row_SPGH=$request->fetch_assoc()){
                    $masp=$row_SPGH['MASP'];
                    $hinh=$row_SPGH['LINK'];
                    $tensp=$row_SPGH['TENSP'];
                    $gia=$row_SPGH['GIA'];
                    $soluonggio=$row_SPGH['SOLUONGGIO'];
                    $tien=$gia*$soluonggio;
                    echo "
                    <tr>
                    <td>
                        <a href='view.php?tenbien=$masp' class='cartItem__product'>
                            <img src='../admin/product_images/".$hinh."' alt=''>
                        </a>
                    </td>
                    <td>
                        <div class='cartItem__product--intro'>
                            <h4>Title</h4>
                            <p>".$tensp."</p>
                        </div>
                    </td>
                    <td>".currency_format($gia,' VND')."</td>
                    <td>
                        <input type='number' name='' id='soluong' min='1' value='".$soluonggio."' oninput='sua_soluong($gia)'>
                    </td>
                    <td>
                        <p style='margin:0' id='tien'>".currency_format($tien,' VND')."</p>
                    </td>
                    <td>
                        <a href='delete.php?mas=$masp'> <i class='fa fa-trash-alt'></i></a>
                    </td>
                </tr>
                <tr class='spacer'></tr>
                    ";
                }
            }
        }else{
            echo "error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
    }

    function currency_format($number, $suffix) {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "$suffix";
        }
    }


?>
