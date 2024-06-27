<?php
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    $magiamgia = tao_id();
    if(isset($_POST['insert_discount'])){
        Check_f5($_POST['insert_discount']);
    }
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
        const Check_all = () => {
            let percent = document.getElementById('phantram').value;
            if(isNaN(percent)){
                alert("Phần trăm bắt buộc phải là số!");
                return false;
            }
        }
    </script>
    <h2>Thêm giảm giá</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form onsubmit="return Check_all()" method="post" enctype="multipart/form-data">
    
        <table align="center" width="100%">
            <tr>
                <td valign="top"><b>Mã giảm giá: </b></td>
                <td><input type="text" name="magiamgia" id="magiamgia" size=60 value="<?php echo $magiamgia?>" disabled /></td>
            </tr>
            <tr>
                <td valign="top"><b>Tên giảm giá: </b></td>
                <td><input type="text" name="tengiamgia" id="tengiamgia" required /></td>
            </tr>

            <tr>
                <td valign="top"><b>Phần trăm: </b></td>
                <td>
                    <input type="text" name="phantram" id="phantram" onkeyup="Check_percent()" required/>
                    <span id="kiemtraphtram"></span>
                </td>
            </tr>
            <tr>
                <td colspan="7" class="text-center"> 
                    <input type="submit" class="btn-submit" name="insert_discount" value="Thêm giảm giá">
                </td>
            </tr>
        </table>
    </form>

</div>

<?php

    
function tao_id(){
    $ktra = "SELECT magiamgia FROM giamgia";
    $res = Check_db($ktra);
    if(mysqli_num_rows($res)>0){
        $sql = "SELECT MAX(magiamgia) FROM giamgia";
        $res = Check_db($sql);
        $row = mysqli_fetch_array($res);
        $sosp =(intval(substr(($row['MAX(magiamgia)']),2))+1);
        $magiamgia = 'GG'.strval($sosp);
    }else{
    $magiamgia = "GG1";
    }
    return $magiamgia;
}
    function Check_Discount($magiamgia){
        $sql = "SELECT * FROM GIAMGIA WHERE magiamgia = '$magiamgia'";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    if(isset($_POST['insert_discount'])){
        // $magiamgia = Get_value($_POST['magiamgia']);
        $tengiamgia = Get_value($_POST['tengiamgia']);
        $phantram = Get_value($_POST['phantram']);
        if(!Check_Discount($magiamgia)){
            $sql_add_discount = "INSERT INTO GIAMGIA (MAGIAMGIA, TENGIAMGIA, PHANTRAM) value ('$magiamgia', '$tengiamgia', $phantram);";
            $res_add_discount = Check_db($sql_add_discount);
            if($res_add_discount){
                echo "<script>alert(\"Thêm giảm giá thành công\")</script>";
            }
        }
        else {
            echo "<script>alert(\"Mã giảm giá đã tồn tại\")</script>";
        }
    }

?>