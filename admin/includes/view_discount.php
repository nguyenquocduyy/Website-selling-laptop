<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
?>
<div class="view_product_box">
    <h2>Giảm giá</h2>
    <div class="border_bottom"></div>
    <form action="" method="post" enctype="multipart/form-data">
        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã giảm giá</th>
                    <th>Tên giảm giá</th>
                    <th>Phần trăm</th>
                    <th>Xóa</th>
                    <th class="text-center">Sửa</th>
                </tr>
            </thead>
            <?php
            $sql_all_discount = "SELECT * FROM GIAMGIA";
            $res_all_discount = Check_db($sql_all_discount);
            while ($row = mysqli_fetch_array($res_all_discount)) {
                $magiamgia = $row['MAGIAMGIA'];
                $tengiamgia = $row['TENGIAMGIA'];
                $phantram = $row['PHANTRAM'];
            ?>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $magiamgia; ?></td>
                    <td><?php echo $tengiamgia; ?></td>
                    <td><?php echo $phantram; ?>%</td>
                    <form method="post">
                        <td>
                            <input class="btn btn-sm btn-danger" style="padding: 4px 15px 4px 15px;"
                                type="submit" name="delete_discount" id="delete_discount" value="Xóa">
                            <input style="display: none" type="text" name="magiamgia" id="magiamgia" value="<?php echo $magiamgia; ?>">
                        </td>
                        <td class="text-center"><a class="btn btn-primary btn-submit btn-sm"
                            href="index.php?action=update_discount&discount_id=<?php echo $magiamgia; ?>">Chỉnh sửa</a>
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
    function View_Discount_Of_Product($masp){
        $sql_discount = "SELECT * FROM giamgia WHERE MAGIAMGIA = (SELECT MAGIAMGIA FROM sanpham WHERE MASP = '$masp');";
        $res_discount = Check_db($sql_discount);
        if(mysqli_num_rows($res_discount) > 0){
            $row_discount = mysqli_fetch_assoc($res_discount);
            return $row_discount['PHANTRAM'];
        }
        else{
            return 100;
        }
    }

    if(isset($_POST['delete_discount'])){
        $magiamgia = $_POST['magiamgia'];
        $sql_del_discount = "DELETE FROM GIAMGIA WHERE magiamgia = '$magiamgia'";
        $res_del_discount = Check_db($sql_del_discount);
        if($res_del_discount){
            echo "<script>alert(\"Xóa mã giảm giá thành công\")</script>";
            echo "<script>window.open('index.php?action=view_discount','_self')</script>";
        }
        else {
            echo "<script>alert('xóa giảm giá không thành công!')</script>";
        }
    }

?>