<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    if(isset($_POST['accept_order'])){
        Check_f5($_POST['accept_order']);
    }
    if(isset($_POST['cancel_order'])){
        Check_f5($_POST['cancel_order']);
    }
?>

<div class="view_product_box">
    <script>
    
    </script>
    <h2>Duyệt đơn hàng</h2>
    <div class="border_bottom"></div>
        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã đơn hàng</th>
                    <th>Tài khoản</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Hình thức thanh toán</th>
                    <th>Địa chỉ nhận</th>
                    <th>Tổng tiền</th>
                    <th>Xem</th>
                    <th>Duyệt</th>
                    <th class="text-center">Từ chối</th>
                </tr>
            </thead>
            <?php
                $sql_all_oder = "SELECT * FROM DONHANG WHERE trangthai = 'Đã xác nhận' OR trangthai = 'Chưa xác nhận'";
                $res_all_oder = Check_db($sql_all_oder);
                while ($row = mysqli_fetch_array($res_all_oder)) {    
                    $madh = $row['MADH'];
                    $taikhoan = $row['TAIKHOAN'];
                    $ngaydat = $row['NGAYDAT'];
                    $trangthai = $row['TRANGTHAI'];
                    $htthanhtoan = $row['HTTHANHTOAN'];
                    $diachinhan = $row['DIACHINHAN'];
                    $tongtien = $row['TONGTIEN'];
            ?>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $madh; ?></td>
                    <td><?php echo $taikhoan; ?></td>
                    <td><?php echo $trangthai; ?></td>
                    <td><?php echo $ngaydat; ?></td>
                    <td><?php echo $htthanhtoan; ?></td>
                    <td><?php echo $diachinhan; ?></td>
                    <td>$<?php echo $tongtien; ?></td>
                    <form method="post">
                        <td><a class="btn btn-danger btn-submit btn-sm" style="margin: 0"
                                href="index.php?action=view_order&order_detail=<?php echo $madh; ?>">Chi tiết</a>
                        </td>
                        <!-- KHI CLICK VAO DOI MAU BUTTON -->
                        <?php  
                            if($trangthai == "Chưa xác nhận"){
                        ?>
                                <td>
                                    <input class="btn btn-sm btn-primary" style="padding: 4px 15px 8px 15px; background: #007BFF; border: #007BFF;" type="submit" name="accept_order" value="Xác nhận">
                                    <input style="display: none" type="text" name="madh" id="madh" value="<?php echo $madh; ?>">
                                </td>
                                <td>
                                    <input class="btn btn-sm btn-danger" style="padding: 4px 15px 8px 15px; background: #red; border: #red;" type="submit" name="cancel_order" value="Từ chối">
                                    <input  style="display: none" type="text" name="madh" id="madh" value="<?php echo $madh; ?>">
                                </td>
                        <?php 
                            }
                            else if($trangthai == "Đã xác nhận"){
                        ?>
                                <td>
                                    <input class="btn btn-sm btn-primary" style="padding: 4px 15px 8px 15px; background: #007BFF; border: #007BFF;" type="submit" name="delivered_order" value="Đã giao">
                                    <input style="display: none" type="text" name="madh" id="madh" value="<?php echo $madh; ?>">
                                </td>
                                <td>
                                    <input class="btn btn-sm btn-danger" style="padding: 4px 15px 8px 15px; background: gray; border: gray;" type="submit" name="cancel_order" value="Từ chối" disabled>
                                    <input  style="display: none" type="text" name="madh" id="madh" value="<?php echo $madh; ?>">
                                </td>
                        <?php
                            }
                            else{
                        ?>
                                <td>
                                    <input class="btn btn-sm btn-primary" style="padding: 4px 15px 8px 15px; background: gray; border: gray;" type="submit" name="accept_order" value="Xác nhận" disabled>
                                    <input style="display: none" type="text" name="madh" id="madh" value="<?php echo $madh; ?>">
                                </td>
                                <td>
                                    <input class="btn btn-sm btn-danger" style="padding: 4px 15px 8px 15px; background: gray; border: gray;" type="submit" name="cancel_order" value="Từ chối" disabled>
                                    <input  style="display: none" type="text" name="madh" id="madh" value="<?php echo $madh; ?>">
                                </td>
                            <?php 
                            }
                            ?>
                    </form>
                </tr>
            </tbody>
            <?php
            } // End while loop 
            ?>
        </table>
</div>

<?php 
    function Check_Status($madh){
        $sql_status = "SELECT * FROM DONHANG WHERE madh = '$madh'";
        $res_status = Check_db($sql_status);
        if(mysqli_num_rows($res_status) > 0){
            $row = mysqli_fetch_assoc($res_status);
            return $row['TRANGTHAI'];
        }
    }

    if(isset($_POST['accept_order'])){
        $madh = $_POST['madh'];
        $sql = "UPDATE DONHANG SET trangthai = 'Đã xác nhận' WHERE MADH = '$madh'";
        $res = Check_db($sql);
        if($res){
            echo "<script>alert('Đã xác nhận đơn hàng')</script>";
            echo "<script>window.open(window.location.href,'_self');</script>";
        }
    }

    if(isset($_POST['cancel_order'])){
        $madh = $_POST['madh'];
        $sql = "UPDATE DONHANG SET trangthai = 'Đã từ chối' WHERE MADH = '$madh'";
        $res = Check_db($sql);
        if($res){
            echo "<script>alert('Đã từ chối đơn hàng')</script>";
            echo "<script>window.open(window.location.href,'_self');</script>";
        }
    }

    if(isset($_POST['delivered_order'])){
        $madh = $_POST['madh'];
        $sql = "UPDATE DONHANG SET trangthai = 'Đã giao hàng' WHERE MADH = '$madh'";
        $res = Check_db($sql);
        if($res){
            echo "<script>alert('Đã hoàn thành đơn hàng')</script>";
            echo "<script>window.open(window.location.href,'_self');</script>";
        }
    }
?>