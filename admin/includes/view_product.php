<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
?>

<div class="view_product_box">
    <h2>Danh sách sản phẩm</h2>
    <div class="border_bottom"></div>
    <form action="" method="post" enctype="multipart/form-data">
        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã sản phẩm</th>
                    <th>Mã loại sản phẩm</th>
                    <th>Mã giảm giá</th>
                    <th>Mã nhà sản xuất</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng còn</th>
                    <th>Ngày sản xuất</th>
                    <th class="text-center">xem</th>
                    <th class="text-center">Xóa</th>
                </tr>
            </thead>
            <?php
            $sql_all_product = "SELECT * FROM SANPHAM";
            $res_all_product = Check_db($sql_all_product);

            while ($row = mysqli_fetch_assoc($res_all_product)) {
                $masp = $row['MASP'];
                $maloaisp = $row['MALOAISP'];
                $magiamgia = $row['MAGIAMGIA'];
                $mansx = $row['MANSX'];
                $tensp = $row['TENSP'];
                $motasp = $row['MOTASP'];
                $ram = $row['RAM'];
                $vixuly = $row['VIXULY'];
                $kichthuocmh = $row['KICHTHUOCMH'];
                $gia = $row['GIA'];
                $soluongcon = $row['SOLUONGCON'];
                $ngaysx = $row['NGAYSX'];
                
                
            ?>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $masp; ?></td>
                    <td><?php echo $maloaisp; ?></td>
                    <td><?php echo $magiamgia; ?></td>
                    <td><?php echo $mansx; ?></td>
                    <td><?php echo $tensp; ?></td>
                    <td>$<?php echo $gia; ?></td>
                    <td><?php echo $soluongcon; ?></td>
                    <td><?php echo $ngaysx; ?></td>
                    <form method="post">
                        <td class="text-center"><a class="btn btn-primary btn-submit btn-sm"
                                href="index.php?action=update_product&product_id=<?php echo $masp; ?>">chi tiết</a>
                            </td>
                        <td class="text-center">
                            <input class="btn btn-sm btn-danger" style="padding: 4px 15px 4px 15px;"
                                type="submit" name="delete_product" id="delete_product" value="Xóa">
                            <input style="display: none" type="text" name="masp" id="masp" value="<?php echo $masp; ?>">
                        </td>
                    </form>
                </tr>
            </tbody>
            <?php
            } // End while loop 
            ?>
        </table>

    </form>

</div>
<?php
if(isset($_POST['delete_product'])){
    $masp = $_POST['masp'];
    echo $masp;
    
    $sql_del_img = "DELETE FROM HINHANH WHERE masp = '$masp';";
    $delete = Check_db($sql_del_img);
    if($delete){
    $sql_del_product = "DELETE FROM SANPHAM WHERE masp = '$masp';";
    Check_db($sql_del_product);
    echo "<script>alert('xóa sản phẩm thành công!')</script>";
    echo "<script>window.open('index.php?action=view_product','_self')</script>";
    }else {
        echo "<script>alert('xóa  sản phẩm thất bại!')</script>";
    }
    
}
?>

<?php 

    function Img_product($masp){
        $sql_img = "SELECT * FROM HINHANH WHERE MASP = '$masp';";
        $res_img = Check_db($sql_img);
        return $res_img;
    }

    function Check_Product($masp){
        if(isset($_POST['checksp'])){
            $sql = "SELECT * FROM SANPHAM WHERE MASP = '$masp';";
            $res = Check_db($sql); 
            if(mysqli_num_rows($res)>0){
                return true;
            }
            else{
                return false;
            }
        }

    }

    function View_Product_Sellest(){
        $sql = "SELECT * FROM sanpham where Masp = (select max(soluongdat) FROM monhang);";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP'];
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
                $motasp = $row['MOTASP'];
                $ngaysx = $row['NGAYSX'];
            }
        }
        else{
            echo "khong tin duoc san pham ban chay nhat";
        }
    }

    function View_Full_Product(){
        $sql = "SELECT * FROM sanpham";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP'];
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $phantram = $row['PHANTRAM'];
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
            }
        }
        else{
            echo "khong tim duoc san pham nao";
        }
    }
    
    function View_full_loai_Of_Product($masp){
        $sql_loai = "SELECT * FROM SANPHAM WHERE MALOAISP = (SELECT MALOAISP FROM SANPHAM WHERE MASP = '$masp')";
        $res_loai = Check_db($sql_loai);
        if(mysqli_num_rows($res_loai) > 0){
            while($row_loai = mysqli_fetch_assoc($res_loai)){
                $maloaisp = $row_loai['maloaisp'];
            }
        } else{
            echo "khong co loai nao";
        }
    }
    
    function View_full_MaNSX_Of_Product($masp){
        $sql_NSX = "SELECT * FROM SANPHAM WHERE MANSX = (SELECT MANSX FROM SANPHAM WHERE MASP = '$masp')";
        $res_NSX = Check_db($sql_NSX);
        if(mysqli_num_rows($res_NSX) > 0){
            while($row_NSX = mysqli_fetch_assoc($res_NSX)){
                $maNSX = $row_NSX['maNSX'];
            }
        } else{
            echo "khong co NSX nao";
        }
    }

?>