<?php
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    if(isset($_POST['update_product'])){
        Check_f5($_POST['update_product']);
    }
    $masp = $_GET['product_id'];
    $update_product = Check_db("SELECT * from sanpham where masp='$masp'");
    $fetch_update = mysqli_fetch_array($update_product);
    $maloaisp = $fetch_update['MALOAISP'];
    $magiamgia = $fetch_update['MAGIAMGIA'];
    $mansx = $fetch_update['MANSX'];
    $tensp = $fetch_update['TENSP'];
    $motasp = $fetch_update['MOTASP'];
    $ram = $fetch_update['RAM'];
    $vixuly = $fetch_update['VIXULY'];
    $kichthuocmh = $fetch_update['KICHTHUOCMH'];
    $gia = $fetch_update['GIA'];
    $soluongcon = $fetch_update['SOLUONGCON'];
    $ngaysx = $fetch_update['NGAYSX'];
?>
<div class="form_box">
    <script>
        const Check_percent = function () {
            let percent = document.getElementById('phantram').value;
            if(!isNaN(percent)){
                document.getElementById('kiemtraphtram').innerHTML = '';
            } else {
                document.getElementById('kiemtraphtram').style.color = 'red';
                document.getElementById('kiemtraphtram').innerHTML = 'Phải là số';
            }
        }

        const check_so = function (so, loi) {
            let ktra = document.getElementById(so).value;
            if(!isNaN(ktra)){
                document.getElementById(loi).innerHTML = '';
            } else {
                document.getElementById(loi).style.color = 'red';
                document.getElementById(loi).innerHTML = 'Phải là số';

            }
        }

        const Check_all = function () {
            let gia = document.getElementById('gia').value;
            let soluongcon = document.getElementById('soluongcon').value;
            if(isNaN(gia)){
                alert("giá bắt buộc phải là số!");
                return false;
            }else if(isNaN(soluongcon)){
                alert("só lượng còn bắt buộc phải là số!");
                return false;
            }
        }
    </script>
    <h2>Sửa sản phẩm</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form method="post" onsubmit="return Check_all()" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td><b>Mã sản phẩm:</b></td>
                <td><input type="text" name="magiamgia" value="<?php echo $masp;?>" size="60" disabled/></td>
            </tr>
            <tr>
                <td valign="top"><b>Mã loại sản phẩm:</b></td>
                <td>
                    <select id="maloaisp" name="maloaisp">
                        <option ><?php echo $maloaisp?></option>
                        <?php
                        $sql_all_cat = "SELECT * FROM  LOAISP";
                        $res_all_cat = Check_db($sql_all_cat);
                        while ($row = mysqli_fetch_assoc($res_all_cat)) {
                        $maloaisp = $row['MALOAISP'];
                        echo "<option>$maloaisp</option>";    
                        }       
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mã giảm giá:  </b></td>
                <td>
                    <select id="magiamgia" name="magiamgia">
                        <option value=''><?php echo $magiamgia?></option>
                        <?php 
                            $sql_all_discount = "SELECT * FROM GIAMGIA";
                            $res_all_discount = Check_db($sql_all_discount);
                            while ($row = mysqli_fetch_array($res_all_discount)) {
                            $magiamgia = $row['MAGIAMGIA'];
                            echo "<option>$magiamgia</option>";
                            }
                        ?>
                    </select> 
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mã nhàs sản xuất:</b></td>
                <td>
                    <select id="mansx" name="mansx" onchange="check_nsx()">
                        <?php
                        $sql_all_nsx = "SELECT * FROM  nhasanxuat";
                        $res_all_nsx = Check_db($sql_all_nsx);
                        while ($row = mysqli_fetch_assoc($res_all_nsx)) {
                        $mansx = $row['MANSX'];
                        echo "<option>$mansx</option>";    
                        }       
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Tên sản phẩm:</b></td>
                <td><input type="text" name="tensp" id="tensx" size = 60 value="<?php echo $tensp ?>" required/>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mô tả sản phẩm: </b></td>
                <td><input type="text" name="motasp" id="motasp" size = 60 value="<?php echo $motasp ?>" required/></td>
            </tr>

            <tr>
            <td valign="top"><b>Ram:</b></td>
            <td>
                <select id="ram" name="ram" >
                <option><?php echo $ram?></option>
                <option>1</option>
                <option>2</option>
                <option>4</option>
                <option>8</option>
                <option>16</option>
                <option>32</option>
                <option>64</option>
                </select>
            </td>
        </tr>

            <tr>
                <td valign="top"><b>Vi xử lý:</b></td>
                <td><input type="text" name="vixuly" id="vixuly"value="<?php echo $vixuly ?>" required/></td>
            </tr>
            <tr>
            <td valign="top"><b>Kích thước màn hình:</b></td>
                        
                <td>

                <select id="kichthuocmh" name="kichthuocmh">
                    <option><?php echo $maloaisp?></option>
                    <option>10.1 inch</option>
                    <option>11.6 inch</option>
                    <option>13.3 inch</option>
                    <option>14 inch</option>
                    <option>14.1 inch</option>
                    <option>15.6 inch</option>
                </select>
                </td>
            </tr>>

            <tr>
                <td valign="top"><b>Giá:</b></td>
                <td><input type="text" name="gia" id="gia"value="<?php echo $gia ?>" required></td>
            </tr>
            <tr>
                <td valign="top"><b>Số lượng còn:</b></td>
                <td><input type="text" name="soluongcon" id="soluongcon" value="<?php echo $soluongcon ?>"></td>
            </tr>
            <tr>
                <td valign="top"><b>Ngày sản xuất:</b></td>
                <td><input type="date" name="ngaysx" id="ngaysx" value="<?php echo $ngaysx ?>"></td>
            </tr>
            <tr>
                <td><b>Hình ảnh: </b></td>
                <td><input type="file" name="files[]"  multiple required /></td>
            </tr>

            <tr>
                <td colspan="13" class="text-center"><input class="btn btn-primary btn-submit" type="submit"
                        name="update_product" value="Lưu" /></td>
            </tr>
        </table>
    </form>
</div>
<?php
   // function Update_Product($masp, $maloaisp, $magiamgia, $mansx, $tensp, $motasp, $ram, $vixuly, $kichthuocmh, $gia, $soluongcon, $ngaysx){
    if(isset($_POST['update_product'])){
            $maloaisp_update = Get_value($_POST["maloaisp"]);
            $magiamgia_update = Get_value($_POST["magiamgia"]);
            $mansx_update = Get_value($_POST["mansx"]);
            $tensp_update = Get_value($_POST["tensp"]);
            $motasp_update = Get_value($_POST["motasp"]);
            $ram_update = Get_value($_POST["ram"]);
            $vixuly_update = Get_value($_POST["vixuly"]);
            $kichthuocmh_update = Get_value($_POST["kichthuocmh"]);
            $gia_update = Get_value($_POST["gia"]);
            $soluongcon_update = Get_value($_POST["soluongcon"]);
            $ngaysx_update = Get_value($_POST["ngaysx"]);
            // $Hinh_update  = $_FILES['Hinh']['name'];
            // $conn = Connect();
            // $sql_hinh= "UPDATE HINHANH SET LINK = '$Hinh_update' where masp = '$masp'";
            // echo $sql;
            // mysqli_query($conn, $sql_hinh);
            // mysqli_close($conn);
            
            $sql_deletehinh = "DELETE FROM HINHANH WHERE masp = '$masp';";
            $conn = Connect();
            $deletehinh= mysqli_query($conn, $sql_deletehinh);
            mysqli_close($conn);
            $temp =0;
            foreach($_FILES['files']['type'] as $key => $value){
                $value = substr($value, 0, 5);
                if($value!= "image"){
                    $temp++;
                }
            } 
            if($temp==0){
            $uploads_dir = '/uploads';
            foreach($_FILES["files"]["error"] as $key => $error) {
                if($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["files"]["tmp_name"][$key];
                        $name = basename($_FILES["files"]["name"][$key]);
                        move_uploaded_file($tmp_name, "product_images/$name");
                        $sql_hinh = "INSERT INTO HINHANH (masp, link) VALUES ('$masp', '$name');";
                        $conn = Connect();
                        $themhinh= mysqli_query($conn, $sql_hinh);
                        mysqli_close($conn);
                }
            }
            if($themhinh){
                if($magiamgia_update==''){
                    $sql = " UPDATE SANPHAM SET  MALOAISP = '$maloaisp_update',MAGIAMGIA =NULL, MANSX = '$mansx_update', TENSP = '$tensp_update', MOTASP = '$motasp_update', RAM ='$ram_update', VIXULY = '$vixuly_update', KICHTHUOCMH = '$kichthuocmh_update', GIA= '$gia_update', SOLUONGCON ='$soluongcon_update', NGAYSX = '$ngaysx_update'WHERE MASP = '$masp'";
                    echo $sql;
                    $conn = Connect();
                    $ngon= mysqli_query($conn, $sql);
                    mysqli_close($conn);
                }else{
                $conn = Connect();
                $sql = " UPDATE SANPHAM SET  MALOAISP = '$maloaisp_update', MAGIAMGIA = '$magiamgia_update', MANSX = '$mansx_update', TENSP = '$tensp_update', MOTASP = '$motasp_update', RAM ='$ram_update', VIXULY = '$vixuly_update', KICHTHUOCMH = '$kichthuocmh_update', GIA= '$gia_update', SOLUONGCON ='$soluongcon_update', NGAYSX = '$ngaysx_update'WHERE MASP = '$masp'";
                $ngon= mysqli_query($conn, $sql);
                mysqli_close($conn);
            
            }
            echo "<script>alert('Sửa sản phẩm thành công');</script>";       
            }
        }else{
            echo "<script>alert('Định dạng hình không đúng');</script>";
    }
        

    
    }

?>