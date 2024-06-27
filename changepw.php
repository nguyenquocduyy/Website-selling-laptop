<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
?>
  
  <form action="" id="formDoiMatKhau">
                <table id="tblDoiMatKhau">
                  <tr>
                    <th>
                      <label for="matKhauCu">Mật khẩu cũ:</label>
                    </th>
                    <td style="width: 10px"></td>
                    <td>
                      <input type="password" name="" id="" />
                    </td>
                  </tr>
                  <tr style="height: 10px">
                    <th></th>
                    <td style="width: 10px"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>
                      <label for="matKhauMoi">Mật khẩu mới:</label>
                    </th>
                    <td style="width: 10px"></td>
                    <td>
                      <input type="password" name="" id="" />
                    </td>
                  </tr>
                  <tr style="height: 10px">
                    <th></th>
                    <td style="width: 10px"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>
                      <label for="confirmMatKhauMoi"
                        >Nhập lại mật khẩu mới:</label
                      >
                    </th>
                    <td style="width: 10px"></td>
                    <td>
                      <input type="password" name="" id="" />
                    </td>
                  </tr>
                  <tr style="height: 10px">
                    <th></th>
                    <td style="width: 10px"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="width: 10px"></td>
                    <td>
                      <input type="submit" name="doimatkhau" value="Đổi mật khẩu"  />
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>

<?php
//   function check_account($taikhoan, $matkhau){
//     $sql_check_pass = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhau'";
//     $res_check_pass = Check_db($sql_check_pass);
//     if(mysqli_num_rows($res_check_pass) > 0){
//         return true;
//     }
//     else {
//         return false;
//     }
// }
  
    require_once('./includes/include.php');
    // function Change_Pw($taikhoan){
        if (isset(($_POST['doimatkhau']))){
            $matkhaucu = Get_value($_POST['matkhaucu']);
            $matkhaumoi = Get_value($_POST['matkhaumoi']);
            $matkhaucu = md5($matkhaucu);
            $matkhaumoi = md5($matkhaumoi);

            $sql = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhaucu'";
            $res = Check_db($sql);
            if(mysqli_num_rows($res) > 0){
              $sqlupdate =  "UPDATE table NGUOIDUNG SET taikhoan = '$taikhoan' AND matkhau = '$matkhaumoi' ";
              $res = Check_db($sqlupdate);
                echo "<script>alert(\"Đổi mật khẩu thành công\")</script>";
            }
            else{
              echo "<script>alert(\"Mật khẩu cũ không trùng khớp\")</script>";
            }
}
?>