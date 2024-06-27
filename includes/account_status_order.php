<thead id="trangThaiDonHang_tblHead">
  <tr>
    <th>Mã đơn hàng</th>
    <th>Ngày đặt</th>
    <!--th>HT thanh toán</th-->
    <th>Địa chỉ nhận</th>
    <th>Tổng tiền</th>
    <th>Trạng thái</th>
    <th colspan="2">Thao tác</th>
  </tr>
</thead>
<tbody id="trangThaiDonHang_tblBody">
  <?php
  $sql_order = "SELECT * FROM `donhang` WHERE TAIKHOAN='$taikhoan' and TRANGTHAI !='Đã từ chối' and TRANGTHAI !='Đã hủy' and TRANGTHAI!='Đã giao'";
  $res_order = Check_db($sql_order);
  if (mysqli_num_rows($res_order)) {
    while ($row = mysqli_fetch_assoc($res_order)) {
      $madh = $row['MADH'];
      $ngaydat = $row['NGAYDAT'];
      $trangthai = $row['TRANGTHAI'];
      $httt = $row['HTTHANHTOAN'];
      $diachi = $row['DIACHINHAN'];
      $tongtien = $row['TONGTIEN'];
  ?>
      <tr>
        <td><?php echo $madh ?></td>
        <td>
          <div class="trangThaiDonHang_product--intro">
            <p><?php echo $ngaydat ?></p>
          </div>
        </td>
        <td><?php echo $diachi ?></td>
        <td><?php echo $tongtien ?></td>
        <td><?php echo $trangthai ?></td>
        <td>
          <a class="btn btn-danger btn-submit btn-sm" style="margin: 0" href="./account_viewIDB.php?madh=<?php echo $madh ?>">Chi tiết</a>
          <?php 
            if($trangthai == "Chưa xác nhận"){
              echo "<td  >
                  <a href='./includes/huy_order.php?madh=$madh' class=\"btn btn-sm btn-primary\" style=\"padding: 4px 15px 8px 15px; background: #007BFF; border: #007BFF;\" type=\"submit\" name=\"accept_order\" >Hủy</a>
                  
              </td>
              ";
          }
          else{
              echo "<td  >
                  <a href='#' class=\"btn btn-sm btn-primary\" style=\"padding: 4px 15px 8px 15px; background: gray; border: gray;\" type=\"submit\" name=\"accept_order\"  disabled>Hủy</a>
                  
              </td>
             ";
          }
          ?>
        </td>
      </tr>
  <?php
    }
  }
  ?>
</tbody>