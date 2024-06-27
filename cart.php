<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if(!isset($_SESSION['taikhoan'])){
    header('Location: login.php');
}
$taikhoan = $_SESSION['taikhoan'];
function View_Discount_Of_Product($masp){
    $sql_discount = "SELECT * FROM giamgia WHERE MAGIAMGIA = (SELECT MAGIAMGIA FROM sanpham WHERE MASP = '$masp');";
    $res_discount = Check_db($sql_discount);
    if (mysqli_num_rows($res_discount) > 0) {
        $row_discount = mysqli_fetch_assoc($res_discount);
        return $row_discount['PHANTRAM'];
    } else {
        return 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
    <!-- header -->
    <?php include('./includes/header.php') ?>
    <!-- cart item -->
    <section class="cartItem">
        <div class="container">
            <table id="tblItem" class="table">
                <thead id="tblHead">
                    <tr>
                        <th>Hình Ảnh Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Số lượng</th>
                        <th>Số Tiền</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody id="tblBody">
                    <?php
                    $sql_cart = "SELECT *,LINK FROM HINHANH,SANPHAMGIOHANG, SANPHAM WHERE SANPHAMGIOHANG.MASP = SANPHAM.MASP AND SANPHAMGIOHANG.MASP=HINHANH.MASP and taikhoan = '$taikhoan'";
                    $res_cart = Check_db($sql_cart);
                    $temp = 0;
                    if (mysqli_num_rows($res_cart)) {
                        $tongtien = 0;
                        while ($row = mysqli_fetch_assoc($res_cart)) {
                            $hinh = $row['LINK'];
                            $masp = $row['MASP'];
                            $tensp = $row['TENSP'];
                            $gia = $row['GIA'];
                            $soluongcon=$row['SOLUONGCON'];
                            $phantram = View_Discount_Of_Product($masp);
                            if ($gia - $gia * $phantram / 100 < $gia) {
                                $gia = $gia - $gia * $phantram / 100;
                            }
                            $soluonggio = $row['SOLUONGGIO'];
                            $temp++;
                    ?>
                            <form method="POST" action="sua.php">
                                <tr>
                                    <td>
                                        <a href="#" class="cartItem__product">
                                            <img src="./admin/product_images/<?php echo $hinh ?>" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="cartItem__product--intro">
                                            <h4><?php echo $tensp ?></h4>
                                        </div>
                                    </td>
                                    <td><?php echo $gia ?></td>
                                    <td>
                                        <input type="number" name="soluonggio" value='<?php echo $soluonggio ?>' min="1" max='<?php echo $soluongcon ?>'>
                                    </td>
                                    <td class="tongTienSP">
                                        <?php echo $gia * $soluonggio;
                                        $tongtien += $gia * $soluonggio;
                                        ?>
                                    </td>
                                    <td>
                                        <input type="text" value="<?php echo $masp ?>" name="masp" style="display: none;">
                                        <a href="xoa.php?masp=<?php echo $masp ?>" style="padding: 10px;"><i class="fa fa-trash-alt"></i></a>
                                        <button type="submit" style="padding: 0; border: 0px solid transparent; background-color:transparent"><i class="fa fa-retweet"></i></button>
                                    </td>
                                </tr>
                            </form>
                    <?php
                        }
                    } //end loop
                    ?>
                </tbody>
                <tfoot id="tblFooter">
                    <tr>
                        <td colspan="4"></td>
                        <th>
                            <span class="spacer"></span>
                            <span>Tổng tiền:</span>
                        </th>
                        <td id="tongTien" name="TongTien">
                            <?php
                            if (isset($tongtien)) {
                                echo $tongtien;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td>
                            <a href="./payment.php"><input type="button" style="padding: 5px 10px;" value="MUA NGAY"></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
    <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?>


</body>