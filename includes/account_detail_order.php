<thead id="trangThaiDonHang_tblHead">
  <tr>
    <th>Hình sản phẩm</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Số tiền</th>
  </tr>
</thead>
<tbody id="trangThaiDonHang_tblBody">
  <?php
  $madh = $_GET['madh'];
  $sql_order = "SELECT * FROM `monhang`,hinhanh,sanpham WHERE monhang.MASP=hinhanh.MASP and monhang.MASP=sanpham.MASP and MADH='$madh'";
  $res_order = Check_db($sql_order);
  if (mysqli_num_rows($res_order) > 0) {
    while ($row = mysqli_fetch_assoc($res_order)) {
      $hinh = $row['LINK'];
      $gia = $row['GIA'];
      $soluong = $row['SOLUONGDAT'];
      $sotien = $gia * $soluong;
  ?>
      <tr>
        <td>
          <img src="./admin/product_images/<?php echo $hinh ?>" class="trangThaiDonHang_product">
        </td>
        <td>
          <div class="trangThaiDonHang_product--intro">
            <p><?php echo $gia ?></p>
          </div>
        </td>
        <td><?php echo $soluong ?></td>
        <td><?php echo $sotien ?></td>
      </tr>
  <?php
    }
  }
  ?>
  <tr>
    <td colspan="4">
      <div class="trangThaiDonHang_product--intro">
        <a class="btn btn-danger btn-submit btn-sm" style="margin: 0" href="./account.php">Trở về</a>
      </div>
    </td>
  </tr>
</tbody>