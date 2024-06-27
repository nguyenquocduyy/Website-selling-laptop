<thead id="tblHead">
  <tr>
    <th>Mã đơn hàng</th>
    <th>Ngày đặt</th>
    <th>Địa chỉ nhận</th>
    <th>Tổng tiền</th>
    <th colspan="2">Trạng thái</th>
  </tr>
</thead>
<tbody id="tblBody">
  <?php
  $sql_order = "SELECT * FROM `donhang` WHERE TAIKHOAN='$taikhoan' and TRANGTHAI !='Đã xác nhận' and TRANGTHAI !='Chưa xác nhận'";
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
          <div class="cartItem__product--intro">
            <p><?php echo $ngaydat ?></p>
          </div>
        </td>
        <td><?php echo $diachi ?></td>
        <td><?php echo $tongtien ?></td>
        <td><?php echo $trangthai ?></td>
        <td>
          <a class="btn btn-danger btn-submit btn-sm" style="margin: 0" href="./account_viewHIS.php?madh=<?php echo $madh ?>">Chi tiết</a>
        </td>
      </tr>
  <?php
    }
  }
  ?>
</tbody>