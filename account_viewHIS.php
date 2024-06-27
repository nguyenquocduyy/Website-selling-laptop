<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$taikhoan = $_SESSION['taikhoan'];
if (isset($_POST['capnhat_tt'])) {
    $TENND = ($_POST["tennd"]);
    $GIOITINH = ($_POST['gioiTinh']);
    $EMAIL = $_POST['email'];
    $SDT = $_POST['sdt'];
    $DIACHI = $_POST['diaChi'];
    // echo $GIOITINH."".$EMAIL."".$SDT;
    $conn = Connect();
    $sql1 = "UPDATE nguoidung SET TENND='$TENND',GIOITINH='$GIOITINH', EMAIL='$EMAIL',SDT='$SDT',DIACHI='$DIACHI' WHERE TAIKHOAN='$taikhoan'";
    if ($conn->query($sql1)) {
    } else {
        echo "error: " . $sql1 . "<br>" . $conn->error;
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>


<body>
    <!-- header -->
    <?php include('./includes/header.php') ?>
    <!-- account info -->
    <section id="account">
        <div class="container">
            <h4>Tài khoản</h4>
            <div class="row">
                <div id="account__left">
                    <ul id="setting__menu">
                        <li>
                            <a href="#TTTK" id="TTTK" onclick="activeTTTK()">Thông tin tài khoản</a>
                        </li>
                        <li>
                            <a href="#TTDH" id="TTDH" onclick="activeTTDH()">Trạng thái đơn hàng</a>
                        </li>
                        <li>
                            <a href="#LSMH" id="LSMH" onclick="activeLSMH()" style="background-color: #ffa600;">Lịch sử mua hàng</a>
                        </li>
                        <li>
                            <a href="#DMK" id="DMK" onclick="activeDMK()">Đổi mật khẩu</a>
                        </li>
                        <li><a href="./logout.php" id="DX">Đăng xuất</a></li>
                    </ul>
                </div>
                <div id="account__right">
                    <div id="myAccount">
                        <!-- PHP cap nhat thong tin tai khoan -->
                        <div id="thongTinTaiKhoan" align="center" style="display: none;">
                            <?php
                            $sql_account = "SELECT * FROM nguoidung where taikhoan = '$taikhoan'";
                            $res_account = Check_db($sql_account);
                            if (mysqli_num_rows($res_account)) {
                                while ($row = mysqli_fetch_assoc($res_account)) {
                                    $tennd = $row['TENND'];
                                    $gioitinh = $row['GIOITINH'];
                                    $sdt = $row['SDT'];
                                    $email = $row['EMAIL'];
                                    $diachi = $row['DIACHI'];

                            ?>
                                    <form action="" method="POST" onsubmit="return CapNhatTT()">
                                        <table>
                                            <tr>
                                                <th>
                                                    <label for="HoTen">Họ tên:</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="tennd" id="HoTen" value="<?php echo $tennd ?>" />
                                                    <span id="errorHoTen"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="gioiTinh">Giới tính:</label>
                                                </th>
                                                <td>
                                                    <input type="radio" name="gioiTinh" id='nam' value="Nam" checked>
                                                    <label for="gioiTinh">Nam</label>
                                                    <input type="radio" name="gioiTinh" id="nu" value="Nữ">
                                                    <label for="gioiTinh">Nữ</label>
                                                    <?php if ($gioitinh == 'Nữ') { ?>
                                                        <script>
                                                            document.getElementById('nu').checked = true;
                                                        </script>
                                                    <?php }
                                                    if ($gioitinh == 'Nam') { ?>
                                                        <script>
                                                            document.getElementById('nam').checked = true;
                                                        </script>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="email">Email:</label>
                                                </th>
                                                <td>
                                                    <input type="email" name="email" id="EmailND" value="<?php echo $email ?>" />
                                                    <span id="errorEmailND"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="sdt">Số điện thoại:</label>
                                                </th>
                                                <td>
                                                    <input type="tel" name="sdt" id="SDTND" value="<?php echo $sdt ?>" />
                                                    <span id="errorSDTND"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="diaChi">Địa chỉ:</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="diaChi" id="DiaChiND" value="<?php echo $diachi ?>" />
                                                    <span id="errorDiaChiND"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit" name="capnhat_tt">Cập nhật</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                            <?php }
                            } ?>
                        </div>
                        <div id="trangThaiDonHang">
                            <table id="trangThaiDonHang_tblItem" class="table">
                                <?php
                                include './includes/account_status_order.php';
                                ?>
                            </table>
                        </div>
                        <div id="lichSuMuaHang" style="display: block;">
                            <div class="lichSuMuaHang">
                                <table id="tblItem" class="table">
                                    <?php
                                    include './includes/account_detail_ordered.php';
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div id="doiMatKhau">
                            <form action="" method="POST" id="formDoiMatKhau" onsubmit="return DoiMK()">
                                <table id="tblDoiMatKhau">
                                    <tr>
                                        <th>
                                            <label for="matKhauCu">Mật khẩu cũ:</label>
                                        </th>
                                        <td style="width: 10px"></td>
                                        <td>
                                            <input type="password" name="mkc" id="oldPassword" />
                                            <span id="errorOldPassword"></span>
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
                                            <input type="password" name="mkm" id="newPassword" />
                                            <span id="errorNewPassword"></span>
                                        </td>
                                    </tr>
                                    <tr style="height: 10px">
                                        <th></th>
                                        <td style="width: 10px"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <label for="confirmMatKhauMoi">Nhập lại mật khẩu mới:</label>
                                        </th>
                                        <td style="width: 10px"></td>
                                        <td>
                                            <input type="password" name="" id="confirmNewPassword" />
                                            <span id="errorConfirmNewPassword"></span>
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
                                            <input type="submit" style="padding: 5px 10px;" value="Đổi mật khẩu" name="dmk" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['dmk'])) {
        $mkc = md5($_POST['mkc']);
        $mkm = MD5($_POST['mkm']);
        $sql_dmk = "SELECT *FROM nguoidung where TAIKHOAN='$taikhoan' and MATKHAU='$mkc'";
        $res_dmk = Check_db($sql_dmk);
        if (mysqli_num_rows($res_dmk)) {
            $update_dmk = "UPDATE nguoidung SET MATKHAU='$mkm' WHERE TAIKHOAN='$taikhoan'";
            $res_mk = Check_db($update_dmk);
            if ($res_mk) {
                echo "<script>alert('Đổi mật khẩu thành công!')</script>";
                echo "<script>window.open('login.php','_self')</script>";
            } else {
                echo "<script>alert('Đổi mật khẩu không thành công!')</script>";
            }
        } else {
            echo "<script>alert('Mật khẩu cũ không đúng!')</script>";
        }
    }
    ?>
    <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?>
    <!-- active -->
    <script>
        function activeTTTK() {
            document.getElementById("TTTK").style.backgroundColor = "#ffa600";
            document.getElementById("TTDH").style.backgroundColor = "transparent";
            document.getElementById("LSMH").style.backgroundColor = "transparent";
            document.getElementById("DMK").style.backgroundColor = "transparent";
            document.getElementById("thongTinTaiKhoan").style.display = "block";
            document.getElementById("trangThaiDonHang").style.display = "none";
            document.getElementById("lichSuMuaHang").style.display = "none";
            document.getElementById("doiMatKhau").style.display = "none";
        }

        function activeTTDH() {
            document.getElementById("TTTK").style.backgroundColor = "transparent";
            document.getElementById("TTDH").style.backgroundColor = "#ffa600";
            document.getElementById("LSMH").style.backgroundColor = "transparent";
            document.getElementById("DMK").style.backgroundColor = "transparent";
            document.getElementById("thongTinTaiKhoan").style.display = "none";
            document.getElementById("trangThaiDonHang").style.display = "block";
            document.getElementById("lichSuMuaHang").style.display = "none";
            document.getElementById("doiMatKhau").style.display = "none";
        }

        function activeLSMH() {
            document.getElementById("TTTK").style.backgroundColor = "transparent";
            document.getElementById("TTDH").style.backgroundColor = "transparent";
            document.getElementById("LSMH").style.backgroundColor = "#ffa600";
            document.getElementById("DMK").style.backgroundColor = "transparent";
            document.getElementById("thongTinTaiKhoan").style.display = "none";
            document.getElementById("trangThaiDonHang").style.display = "none";
            document.getElementById("lichSuMuaHang").style.display = "block";
            document.getElementById("doiMatKhau").style.display = "none";
        }

        function activeDMK() {
            document.getElementById("TTTK").style.backgroundColor = "transparent";
            document.getElementById("TTDH").style.backgroundColor = "transparent";
            document.getElementById("LSMH").style.backgroundColor = "transparent";
            document.getElementById("DMK").style.backgroundColor = "#ffa600";
            document.getElementById("thongTinTaiKhoan").style.display = "none";
            document.getElementById("trangThaiDonHang").style.display = "none";
            document.getElementById("lichSuMuaHang").style.display = "none";
            document.getElementById("doiMatKhau").style.display = "block";
        }
    </script>
    <!-- MAIN JS -->
    <!-- <script src="./js/main.js"></script> -->

</body>

</html>