
<?php
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    if(isset($_POST['themnsx'])){
        Check_f5($_POST['themnsx']);
    }
?>

<div class="form_box">
    <script>
        
        
    </script>
    <h2>Thêm Nhà Sản Xuất</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form method="post" enctype="multipart/form-data">
    
        <table align="center" width="100%">
            <tr>
                <td valign="top"><b>Mã nhà sản xuất:</b></td>
                <td><input type="text" name="mansx" id="mansx"  required/></td>
            </tr>
            <tr>
                <td valign="top"><b>Tên nhà sản xuất:</b></td>
               <td> <input type="text" name="tennsx" id="tennsx" required/></td>
            </tr>
            <tr>

                <td colspan="2" class="text-center"> 
                    <input type="submit" class="btn-submit" name="themnsx" value="Thêm nhà sản xuất">
                </td>
            </tr>
        </table>
    </form>

</div>
<?php
    function check_Mansx($mansx){
        $sql = "SELECT * FROM nhasanxuat WHERE mansx ='$mansx';";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            return true;
        }
        else{
            return false;
        }
    }
    if (isset($_POST['themnsx'])){
            $mansx = Get_value($_POST["mansx"]);
            $tennsx = Get_value($_POST["tennsx"]);
            
            if(!check_Mansx($mansx)){
            $conn = Connect();
            $sql = "INSERT INTO `nhasanxuat` (`mansx`, `tennsx`) VALUES ('$mansx', '$tennsx');" ;
            mysqli_query($conn, $sql);
            mysqli_close($conn);
                echo "<script>alert(\"Thêm nhà sản xuất thành công\");</script>";
            }else{
                echo "<script>alert(\"Nhà sản xuất đã tồn tại\");</script>";
            }
        }

            ?>